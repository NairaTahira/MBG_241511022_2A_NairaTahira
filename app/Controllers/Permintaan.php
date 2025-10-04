<?php
namespace App\Controllers;

use App\Models\PermintaanModel;
use App\Models\PermintaanDetailModel;
use App\Models\BahanBakuModel;

class Permintaan extends BaseController
{
    protected $permintaanModel;
    protected $detailModel;
    protected $bahanModel;

    public function __construct()
    {
        $this->permintaanModel = new PermintaanModel();
        $this->detailModel     = new PermintaanDetailModel();
        $this->bahanModel      = new BahanBakuModel();
    }

    // List permintaan (by dapur user)
    public function index()
    {
        // Join users to show pemohon name
        $permintaan = $this->permintaanModel
            ->select('permintaan.*, user.name as pemohon_name')
            ->join('user', 'user.id = permintaan.pemohon_id')
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $data = [
            'title'      => 'Daftar Permintaan',
            'permintaan' => $permintaan,
            'content'    => view('permintaan/index', ['permintaan' => $permintaan])
        ];

        return view('view_template_01', $data);
    }
    
    // Form create permintaan
    public function create()
    {
        $bahan = $this->bahanModel
            ->where('jumlah >', 0)
            ->where('status !=', 'kadaluarsa')
            ->findAll();

        $data = [
            'title'   => 'Buat Permintaan',
            'content' => view('permintaan/create', ['bahan' => $bahan])
        ];
        return view('view_template_01', $data);
    }

    // Store permintaan of Client
    public function store()
{
    $data = [
        'pemohon_id'   => session()->get('user_id'),
        'tgl_masak'    => $this->request->getPost('tgl_masak'),
        'menu_makan'   => $this->request->getPost('menu_makan'),
        'jumlah_porsi' => $this->request->getPost('jumlah_porsi'),
        'status'       => 'menunggu',
        'created_at'   => date('Y-m-d H:i:s')
    ];

    $permintaanId = $this->permintaanModel->insert($data);

    if (!$permintaanId) {
        dd($this->permintaanModel->errors());
    }

    // Save detail bahan
    $bahanIds  = $this->request->getPost('bahan_id');
    $jumlahDiminta = $this->request->getPost('jumlah_diminta');

    if ($bahanIds && $jumlahDiminta) {
        foreach ($bahanIds as $i => $bid) {
            if (!empty($bid) && !empty($jumlahDiminta[$i])) {
                $this->detailModel->insert([
                    'permintaan_id'  => $permintaanId,
                    'bahan_id'       => $bid,
                    'jumlah_diminta' => $jumlahDiminta[$i]
                ]);
            }
        }
    }

    return redirect()->to('/permintaan')->with('success', 'Request Successfully Made!');
}

    // View detail
    public function view($id)
    {
        // Join user to get pemohon name
        $permintaan = $this->permintaanModel
                        ->select('permintaan.*, user.name as pemohon_name')
                        ->join('user', 'user.id = permintaan.pemohon_id')
                        ->where('permintaan.id', $id)
                        ->first();

        // Join bahan_baku to get nama + satuan
        $details = $this->detailModel
                        ->select('permintaan_detail.*, bahan_baku.nama as nama_bahan, bahan_baku.satuan as satuan_bahan')
                        ->join('bahan_baku', 'bahan_baku.id = permintaan_detail.bahan_id', 'left')
                        ->where('permintaan_detail.permintaan_id', $id)
                        ->findAll();

        $data = [
            'title'   => 'Detail Permintaan',
            'content' => view('permintaan/view', [
                'permintaan' => $permintaan,
                'details'    => $details
            ])
        ];

        return view('view_template_01', $data);
    }


    /**
     * Admin: list pending requests
     */
    public function adminIndex()
    {
        // only gudang allowed by routes/filter
        $pending = $this->permintaanModel->select('permintaan.*, user.name as pemohon_name')
                                         ->join('user', 'user.id = permintaan.pemohon_id')
                                         ->where('status', 'menunggu')
                                         ->orderBy('created_at','ASC')
                                         ->findAll();

        $data = [
            'title' => 'Permintaan - Menunggu Persetujuan',
            'content' => view('permintaan/admin_index', ['permintaan' => $pending])
        ];
        return view('view_template_01', $data);
    }

    //Admin: Approve request -> deduct stock and update statuses
    
    public function approve($id)
    {
        $perm = $this->permintaanModel->find($id);
        if (!$perm) return redirect()->back()->with('error', 'Permintaan tidak ditemukan.');

        // load detail lines
        $details = $this->detailModel->where('permintaan_id', $id)->findAll();

        $db = \Config\Database::connect();
        $db->transStart();

        // try reduce stocks
        foreach ($details as $d) {
            $bahan = $this->bahanModel->find($d['bahan_id']);
            if (!$bahan) {
                $db->transRollback();
                return redirect()->back()->with('error', 'Bahan tidak ditemukan: id='.$d['bahan_id']);
            }

            $need = (int)$d['jumlah_diminta'];
            $stok = (int)$bahan['jumlah'];

            if ($need > $stok) {
                $db->transRollback();
                return redirect()->back()->with('error', "Stok tidak cukup untuk bahan {$bahan['nama']} (stok: {$stok}, minta: {$need})");
            }

            $newstok = $stok - $need;

            $this->bahanModel->update($bahan['id'], ['jumlah' => $newstok]);

            // recompute and save status
            $bahanAfter = $this->bahanModel->find($bahan['id']);
            $newStatus = $this->bahanModel->computeStatus($bahanAfter);
            $this->bahanModel->update($bahan['id'], ['status' => $newStatus]);
        }

        // set permintaan status to disetujui
        $this->permintaanModel->update($id, ['status' => 'disetujui']);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Gagal memproses persetujuan (transaksi gagal).');
        }

        return redirect()->back()->with('success', 'Permintaan disetujui dan stok telah dikurangi.');
    }

    /**
     * Admin: Reject -> optional reason
     */
    public function reject($id)
    {
        $perm = $this->permintaanModel->find($id);
        if (!$perm) return redirect()->back()->with('error', 'Permintaan tidak ditemukan.');

        $reason = $this->request->getPost('alasan') ?? $this->request->getVar('alasan') ?? null;

        $this->permintaanModel->update($id, ['status' => 'ditolak', 'alasan' => $reason]);

        return redirect()->back()->with('success', 'Permintaan ditolak.');
    }
}
