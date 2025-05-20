<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelOrangtua;

class Orangtua extends BaseController
{
    public function __construct()
    {
        $this->ModelOrangtua = new ModelOrangtua();
    }

    public function index()
    {
        $data = [
            'menu' => 'orangtua',
            'page' => 'v_orangtua',
            'jml_kelas' => $this->ModelOrangtua->JumlahKelas(),
            'jml_siswa' => $this->ModelOrangtua->JumlahSiswa(),
            'jml_pembayaran' => $this->ModelOrangtua->JumlahPembayaran(),
            'jml_transaksi' => $this->ModelOrangtua->JumlahTransaksiPembayaran(),
        ];
        return view('v_template', $data);
    }
}
