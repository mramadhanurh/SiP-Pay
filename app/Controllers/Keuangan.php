<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelKeuangan;

class Keuangan extends BaseController
{
    public function __construct()
    {
        $this->ModelKeuangan = new ModelKeuangan();
    }

    public function index()
    {
        $data = [
            'menu' => 'keuangan',
            'page' => 'v_keuangan',
            'jml_kelas' => $this->ModelKeuangan->JumlahKelas(),
            'jml_siswa' => $this->ModelKeuangan->JumlahSiswa(),
            'jml_pembayaran' => $this->ModelKeuangan->JumlahPembayaran(),
            'jml_user' => $this->ModelKeuangan->JumlahUser(),
        ];
        return view('v_template', $data);
    }
}
