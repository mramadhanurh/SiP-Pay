<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Keuangan extends BaseController
{
    public function index()
    {
        $data = [
            'menu' => 'keuangan',
            'page' => 'v_keuangan',
        ];
        return view('v_template', $data);
    }
}
