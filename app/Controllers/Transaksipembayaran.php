<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTransaksipembayaran;
use App\Models\ModelUser;
use App\Models\ModelPembayaran;
use Dompdf\Dompdf;

class Transaksipembayaran extends BaseController
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
            'judul' => 'Transaksi Pembayaran',
            'subjudul' => 'Transaksi Pembayaran',
            'menu' => 'transaksipembayaran',
            'submenu' => '',
            'page' => 'v_transaksipembayaran',
            'transaksi' => $this->ModelTransaksipembayaran->AllData(),
            'user' => $this->ModelUser->AllData(),
            'pembayaran' => $this->ModelPembayaran->AllData(),
        ];
        return view('v_template', $data);
    }

    public function InsertData()
    {
        $file = $this->request->getFile('bukti_bayar');
        
        // Buat nama file unik agar tidak bentrok
        $namaFile = $file->getRandomName();

        // Pindahkan file ke folder public/bukti_bayar/
        $file->move('bukti_bayar', $namaFile);

        $data = [
            'id_user' => $this->request->getPost('id_user'),
            'id_pembayaran' => $this->request->getPost('id_pembayaran'),
            'tanggal_bayar' => $this->request->getPost('tanggal_bayar'),
            'jumlah_bayar' => $this->request->getPost('jumlah_bayar'),
            'metode_bayar' => $this->request->getPost('metode_bayar'),
            'status_notif' => $this->request->getPost('status_notif'),
            'bukti_bayar' => $namaFile,
        ];
        $this->ModelTransaksipembayaran->InsertData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!');
        return redirect()->to('Transaksipembayaran');
    }

    public function UpdateData($id_transaksi_pembayaran)
    {
        // Ambil file yang diupload
        $file = $this->request->getFile('bukti_bayar');

        // Ambil data lama untuk hapus gambar lama jika perlu
        $oldData = $this->ModelTransaksipembayaran->DetailData($id_transaksi_pembayaran);

        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Generate nama file baru
            $namaFile = $file->getRandomName();

            // Upload file
            $file->move('bukti_bayar', $namaFile);

            // Hapus file lama (opsional)
            if ($oldData['bukti_bayar'] && file_exists('bukti_bayar/' . $oldData['bukti_bayar'])) {
                unlink('bukti_bayar/' . $oldData['bukti_bayar']);
            }
        } else {
            // Jika tidak upload file baru, gunakan file lama
            $namaFile = $oldData['bukti_bayar'];
        }

        $data = [
            'id_transaksi_pembayaran' => $id_transaksi_pembayaran,
            'id_user' => $this->request->getPost('id_user'),
            'id_pembayaran' => $this->request->getPost('id_pembayaran'),
            'tanggal_bayar' => $this->request->getPost('tanggal_bayar'),
            'jumlah_bayar' => $this->request->getPost('jumlah_bayar'),
            'metode_bayar' => $this->request->getPost('metode_bayar'),
            'status_notif' => $this->request->getPost('status_notif'),
            'bukti_bayar' => $namaFile,
        ];
        $this->ModelTransaksipembayaran->UpdateData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diupdate!');
        return redirect()->to('Transaksipembayaran');
    }

    public function DeleteData($id_transaksi_pembayaran)
    {
        // Ambil data lama
        $oldData = $this->ModelTransaksipembayaran->DetailData($id_transaksi_pembayaran);

        // Hapus file bukti jika ada
        if ($oldData && $oldData['bukti_bayar'] && file_exists('bukti_bayar/' . $oldData['bukti_bayar'])) {
            unlink('bukti_bayar/' . $oldData['bukti_bayar']);
        }

        // Hapus data dari database
        $this->ModelTransaksipembayaran->DeleteData(['id_transaksi_pembayaran' => $id_transaksi_pembayaran]);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!');
        return redirect()->to('Transaksipembayaran');
    }

    public function PembayaranOrangtua()
    {
        // Ambil nisn dari session
        $nisn = session()->get('nisn');

        $data = [
            'judul' => 'Pembayaran Orang Tua',
            'subjudul' => 'Pembayaran Orang Tua',
            'menu' => 'pembayaranorangtua',
            'submenu' => '',
            'page' => 'v_pembayaranorangtua',
            'transaksi' => $this->ModelTransaksipembayaran->DataByNISN($nisn),
            'user' => $this->ModelUser->AllData(),
            'pembayaran' => $this->ModelPembayaran->AllData(),
        ];
        return view('v_template', $data);
    }

    public function UpdateDataPembayaranOrangtua($id_transaksi_pembayaran)
    {
        // Ambil file yang diupload
        $file = $this->request->getFile('bukti_bayar');

        // Ambil data lama untuk hapus gambar lama jika perlu
        $oldData = $this->ModelTransaksipembayaran->DetailData($id_transaksi_pembayaran);

        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Generate nama file baru
            $namaFile = $file->getRandomName();

            // Upload file
            $file->move('bukti_bayar', $namaFile);

            // Hapus file lama (opsional)
            if ($oldData['bukti_bayar'] && file_exists('bukti_bayar/' . $oldData['bukti_bayar'])) {
                unlink('bukti_bayar/' . $oldData['bukti_bayar']);
            }
        } else {
            // Jika tidak upload file baru, gunakan file lama
            $namaFile = $oldData['bukti_bayar'];
        }

        $data = [
            'id_transaksi_pembayaran' => $id_transaksi_pembayaran,
            'bukti_bayar' => $namaFile,
        ];
        $this->ModelTransaksipembayaran->UpdateData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diupdate!');
        return redirect()->to('Transaksipembayaran/PembayaranOrangtua');
    }

    public function CetakPembayaranOrangtua()
    {
        // Ambil nisn dari session
        $nisn = session()->get('nisn');

        $data = [
            'judul' => 'Cetak Pembayaran',
            'subjudul' => 'Cetak Pembayaran',
            'menu' => 'cetakpembayaran',
            'submenu' => '',
            'page' => 'v_cetakpembayaranorangtua',
            'transaksi' => $this->ModelTransaksipembayaran->DataByNISN($nisn),
            'user' => $this->ModelUser->AllData(),
            'pembayaran' => $this->ModelPembayaran->AllData(),
        ];
        return view('v_template', $data);
    }

    public function CetakTransaksi($id_transaksi)
    {
        // Ambil data transaksi berdasarkan ID
        $data = [
            'judul' => 'Struk Pembayaran',
            'transaksi' => $this->ModelTransaksipembayaran->DetailTransaksi($id_transaksi),
        ];

        // Load view untuk pdf
        $html = view('v_strukpembayaran', $data);

        // Inisialisasi Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output ke browser
        $dompdf->stream('struk_pembayaran.pdf', ['Attachment' => false]);
    }
}
