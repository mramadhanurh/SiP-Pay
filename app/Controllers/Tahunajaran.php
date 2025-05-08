<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTahunajaran;

class Tahunajaran extends BaseController
{
    public function __construct()
    {
        $this->ModelTahunajaran = new ModelTahunajaran();
    }

    public function index()
    {
        $data = [
            'judul' => 'Tahun Ajaran',
            'subjudul' => 'Tahun Ajaran',
            'menu' => 'tahun_ajaran',
            'submenu' => '',
            'page' => 'v_tahun_ajaran',
            'tahun' => $this->ModelTahunajaran->AllData(),
        ];
        return view('v_template', $data);
    }

    public function InsertData()
    {
        // Ambil data dari input
        $inputTahun = $this->request->getPost('tahun'); // format: YYYY-MM

        // Ambil hanya bagian tahun
        $tahunSaja = date('Y', strtotime($inputTahun));

        $data = [
            'tahun' => $tahunSaja,
            'semester' => $this->request->getPost('semester'),
        ];
        $this->ModelTahunajaran->InsertData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!');
        return redirect()->to('Tahunajaran');
    }

    public function UpdateData($id_tahun_ajaran)
    {
        $inputTahun = $this->request->getPost('tahun');
        $tahunSaja = date('Y', strtotime($inputTahun));

        $data = [
            'id_tahun_ajaran' => $id_tahun_ajaran,
            'tahun' => $tahunSaja,
            'semester' => $this->request->getPost('semester'),
        ];
        $this->ModelTahunajaran->UpdateData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diupdate!');
        return redirect()->to('Tahunajaran');
    }

    public function DeleteData($id_tahun_ajaran)
    {
        $data = [
            'id_tahun_ajaran' => $id_tahun_ajaran,
        ];
        $this->ModelTahunajaran->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!');
        return redirect()->to('Tahunajaran');
    }
}
