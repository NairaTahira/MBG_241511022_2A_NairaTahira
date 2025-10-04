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


    // List all the raw materials
    public function index()
    {

        $bahanBaku = $this->model->findAll();

        $data = [
            'title'   => 'Daftar Bahan Baku',
            'content' => view('bahanbaku/index', ['bahan_baku' => $bahanBaku])
        ];
        return view('view_template_01', $data);
    }

    // To create a new raw material

    public function create()
    {
        if (session()->get('role') !== 'gudang') return redirect()->to('/bahanbaku');

        $data = [
            'title'   => 'Add Bahan Baku',
            'content' => view('bahanbaku/create')
        ];
        return view('view_template_01', $data);
    }


    // Storing new raw material
    public function store()
    {
        $this->model->save([
            'nama' => $this->request->getPost('nama'),
            'kategori' => $this->request->getPost('course_name'),
            'jumlah'     => $this->request->getPost('jumlah'),
            'satuan' => $this->request->getPost('satuan'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'tanggal_kadaluarsa' => $this->request->getPost('tanggal_kadaluarsa'),
            'status' => $this->request->getPost('status'),
            'created_at'         => date('Y-m-d H:i:s')
        ]);
        return redirect()->to('/bahanbaku');
    }


    // Edit raw material
    public function edit($id)
    {
        $bahan = $this->model->find($id);
        $data = [
            'title'   => 'Edit Bahan Baku',
            'content' => view('bahanbaku/edit', ['bahan' => $bahan])
        ];
        return view('view_template_01', $data);
    }


    // Update raw material
    public function update($id)
    {
        $this->model->update($id, [
            'nama' => $this->request->getPost('nama'),
            'kategori' => $this->request->getPost('kategori'),
            'jumlah'     => $this->request->getPost('jumlah'),
            'satuan' => $this->request->getPost('satuan'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'tanggal_kadaluarsa' => $this->request->getPost('tanggal_kadaluarsa'),
            'status' => $this->request->getPost('status'),
        ]);
        return redirect()->to('/bahanbaku');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/bahanbaku');
    }
}
