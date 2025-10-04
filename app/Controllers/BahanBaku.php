<?php
namespace App\Controllers;

use App\Models\BahanBakuModel;

class BahanBaku extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new BahanBakuModel(); 
    }


    // Index — compute & persist statuses, then show list
    public function index()
    {
        $all = $this->model->findAll();

        // Recompute statuses and persist if changed
        foreach ($all as $row) {
            $newStatus = $this->model->computeStatus($row);
            if ($newStatus !== $row['status']) {
                $this->model->update($row['id'], ['status' => $newStatus]);
                $row['status'] = $newStatus;
            }
        }

        // reload after updates
        $bahanBaku = $this->model->orderBy('id','ASC')->findAll();

        $data = [
            'title'   => 'Lists of Raw Materials',
            'content' => view('bahanbaku/index', ['bahan_baku' => $bahanBaku])
        ];
        return view('view_template_01', $data);
    }

    // To create a new raw material

    public function create()
    {
        if (session()->get('role') !== 'gudang') return redirect()->to('/bahanbaku');

        $data = [
            'title'   => 'Add Raw Materials',
            'content' => view('bahanbaku/create')
        ];
        return view('view_template_01', $data);
    }

    // Store — ensure status default to 'tersedia' on insert
    public function store()
    {
        $jumlah = (int)$this->request->getPost('jumlah');

        $status = 'tersedia';
        if ($jumlah <= 0) $status = 'habis';

        $this->model->insert([
            'nama' => $this->request->getPost('nama'),
            'kategori' => $this->request->getPost('kategori'),
            'jumlah' => $jumlah,
            'satuan' => $this->request->getPost('satuan'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'tanggal_kadaluarsa' => $this->request->getPost('tanggal_kadaluarsa'),
            'status' => $status,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/bahanbaku')->with('success', 'Bahan baku ditambahkan.');
    }


    // Edit raw material
    public function edit($id)
    {
        $bahan = $this->model->find($id);
        $data = [
            'title'   => 'Edit Raw Materials',
            'content' => view('bahanbaku/edit', ['bahan' => $bahan])
        ];
        return view('view_template_01', $data);
    }


    // Update — validate jumlah >= 0
    public function update($id)
    {
        $jumlah = (int)$this->request->getPost('jumlah');

        if ($jumlah < 0) {
            return redirect()->back()->with('error', 'The stock value cannot be less than 0.');
        }

        $this->model->update($id, [
            'nama' => $this->request->getPost('nama'),
            'kategori' => $this->request->getPost('kategori'),
            'jumlah' => $jumlah,
            'satuan' => $this->request->getPost('satuan'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'tanggal_kadaluarsa' => $this->request->getPost('tanggal_kadaluarsa'),
        ]);

        // recompute status immediately
        $bahan = $this->model->find($id);
        $newStatus = $this->model->computeStatus($bahan);
        $this->model->update($id, ['status' => $newStatus]);

        return redirect()->to('/bahanbaku')->with('success', 'Data updated successfully.');
    }

    // Show confirm delete page
    public function confirmDelete($id)
    {
        $bahan = $this->model->find($id);
        $data = [
            'title' => 'Confirm Delete Material',
            'content' => view('bahanbaku/confirm_delete', ['bahan' => $bahan])
        ];
        return view('view_template_01', $data);
    }

    // Delete — only allowed if status == 'kadaluarsa'
    public function delete($id)
    {
        $bahan = $this->model->find($id);
        if (!$bahan) {
            return redirect()->to('/bahanbaku')->with('error', 'Data not Found.');
        }

        if ($bahan['status'] !== 'kadaluarsa') {
            return redirect()->to('/bahanbaku')->with('error', 'Removing Available Raw Materials are Prohibited.');
        }

        $this->model->delete($id);
        return redirect()->to('/bahanbaku')->with('success', 'Expired raw material has been removed.');
    }
}
