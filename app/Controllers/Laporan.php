<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTransaksipembayaran;
use App\Models\ModelUser;
use App\Models\ModelPembayaran;
use Dompdf\Dompdf;
use Dompdf\Options;

class Laporan extends BaseController
{
    public function __construct()
    {
        $this->ModelTransaksipembayaran = new ModelTransaksipembayaran();
        $this->ModelUser = new ModelUser();
        $this->ModelPembayaran = new ModelPembayaran();
    }

    public function index()
    {
        $data = [
            'judul' => 'Laporan Pembayaran',
            'subjudul' => 'Laporan Pembayaran',
            'menu' => 'laporanpembayaran',
            'submenu' => '',
            'page' => 'v_laporanpembayaran',
            'transaksi' => $this->ModelTransaksipembayaran->AllData(),
            'user' => $this->ModelUser->AllData(),
            'pembayaran' => $this->ModelPembayaran->AllData(),
        ];
        return view('v_template', $data);
    }

    public function cetak()
    {
        $data = [
            'judul' => 'Laporan Pembayaran',
            'transaksi' => $this->ModelTransaksipembayaran->AllData(),
        ];

        // Load view khusus cetak
        $html = view('pdf_laporan', $data);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream('laporan_pembayaran.pdf', ['Attachment' => false]);
    }
}
