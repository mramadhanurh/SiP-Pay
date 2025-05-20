<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAdmin;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->ModelAdmin = new ModelAdmin();
    }

    public function index()
    {
        $data = [
            'menu' => 'admin',
            'page' => 'v_admin',
            'jml_kelas' => $this->ModelAdmin->JumlahKelas(),
            'jml_siswa' => $this->ModelAdmin->JumlahSiswa(),
            'jml_pembayaran' => $this->ModelAdmin->JumlahPembayaran(),
            'jml_user' => $this->ModelAdmin->JumlahUser(),
        ];
        return view('v_template', $data);
    }
}
