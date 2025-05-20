<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPembayaran;
use App\Models\ModelSiswa;
use App\Models\ModelTahunajaran;

class Pembayaran extends BaseController
{
    public function __construct()
    {
        $this->ModelPembayaran = new ModelPembayaran();
        $this->ModelSiswa = new ModelSiswa();
        $this->ModelTahunajaran = new ModelTahunajaran();
    }

    public function index()
    {
        $data = [
            'judul' => 'Pembayaran',
            'subjudul' => 'Pembayaran',
            'menu' => 'pembayaran',
            'submenu' => '',
            'page' => 'v_pembayaran',
            'pembayaran' => $this->ModelPembayaran->AllData(),
            'siswa' => $this->ModelSiswa->AllData(),
            'tahun_ajaran' => $this->ModelTahunajaran->AllData(),
        ];
        return view('v_template', $data);
    }

    public function InsertData()
    {
        $data = [
            'id_siswa' => $this->request->getPost('id_siswa'),
            'id_tahun_ajaran' => $this->request->getPost('id_tahun_ajaran'),
            'jumlah_tagihan' => $this->request->getPost('jumlah_tagihan'),
            'status' => $this->request->getPost('status'),
            'tgl_jatuh_tempo' => $this->request->getPost('tgl_jatuh_tempo'),
        ];
        $this->ModelPembayaran->InsertData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!');
        return redirect()->to('Pembayaran');
    }

    public function UpdateData($id_pembayaran)
    {
        $data = [
            'id_pembayaran' => $id_pembayaran,
            'id_siswa' => $this->request->getPost('id_siswa'),
            'id_tahun_ajaran' => $this->request->getPost('id_tahun_ajaran'),
            'jumlah_tagihan' => $this->request->getPost('jumlah_tagihan'),
            'status' => $this->request->getPost('status'),
            'tgl_jatuh_tempo' => $this->request->getPost('tgl_jatuh_tempo'),
        ];
        $this->ModelPembayaran->UpdateData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diupdate!');
        return redirect()->to('Pembayaran');
    }

    public function DeleteData($id_pembayaran)
    {
        $data = [
            'id_pembayaran' => $id_pembayaran,
        ];
        $this->ModelPembayaran->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!');
        return redirect()->to('Pembayaran');
    }
}
