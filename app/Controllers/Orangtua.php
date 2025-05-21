<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTransaksipembayaran;
use App\Models\ModelOrangtua;

class Orangtua extends BaseController
{
    public function __construct()
    {
        $this->ModelTransaksipembayaran = new ModelTransaksipembayaran();
        $this->ModelOrangtua = new ModelOrangtua();
    }

    public function index()
    {
        // Ambil nisn dari session
        $nisn = session()->get('nisn');

        $data = [
            'menu' => 'orangtua',
            'page' => 'v_orangtua',
            'jml_kelas' => $this->ModelOrangtua->JumlahKelas(),
            'jml_siswa' => $this->ModelOrangtua->JumlahSiswa(),
            'jml_pembayaran' => $this->ModelOrangtua->JumlahPembayaran(),
            'jml_transaksi' => $this->ModelOrangtua->JumlahTransaksiPembayaran(),
            'transaksi' => $this->ModelTransaksipembayaran->DataByNISNNotif($nisn),
        ];
        return view('v_template', $data);
    }
}
