<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelKelas;

class Kelas extends BaseController
{
    public function __construct()
    {
        $this->ModelKelas = new ModelKelas();
    }

    public function index()
    {
        $data = [
            'judul' => 'Kelas',
            'subjudul' => 'Kelas',
            'menu' => 'kelas',
            'submenu' => '',
            'page' => 'v_kelas',
            'kelas' => $this->ModelKelas->AllData(),
        ];
        return view('v_template', $data);
    }

    public function InsertData()
    {
        $data = [
            'nama_kelas' => $this->request->getPost('nama_kelas'),
            'tingkat' => $this->request->getPost('tingkat'),
        ];
        $this->ModelKelas->InsertData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!');
        return redirect()->to('Kelas');
    }

    public function UpdateData($id_kelas)
    {
        $data = [
            'id_kelas' => $id_kelas,
            'nama_kelas' => $this->request->getPost('nama_kelas'),
            'tingkat' => $this->request->getPost('tingkat'),
        ];
        $this->ModelKelas->UpdateData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diupdate!');
        return redirect()->to('Kelas');
    }

    public function DeleteData($id_kelas)
    {
        $data = [
            'id_kelas' => $id_kelas,
        ];
        $this->ModelKelas->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!');
        return redirect()->to('Kelas');
    }
}
