<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelSiswa;
use App\Models\ModelKelas;
use App\Models\ModelTahunajaran;
use App\Models\ModelUser;

class Siswa extends BaseController
{
    public function __construct()
    {
        $this->ModelSiswa = new ModelSiswa();
        $this->ModelKelas = new ModelKelas();
        $this->ModelTahunajaran = new ModelTahunajaran();
        $this->ModelUser = new ModelUser();
    }

    public function index()
    {
        $data = [
            'judul' => 'Siswa',
            'subjudul' => 'Siswa',
            'menu' => 'siswa',
            'submenu' => '',
            'page' => 'v_siswa',
            'siswa' => $this->ModelSiswa->AllData(),
            'kelas' => $this->ModelKelas->AllData(),
            'tahun_ajaran' => $this->ModelTahunajaran->AllData(),
        ];
        return view('v_template', $data);
    }

    public function InsertData()
    {
        $siswaModel = new ModelSiswa();
        $userModel  = new ModelUser();

        // Ambil data dari form
        $nisn           = $this->request->getPost('nisn');
        $nama_siswa     = $this->request->getPost('nama_siswa');
        $id_kelas       = $this->request->getPost('id_kelas');
        $id_tahun_ajaran= $this->request->getPost('id_tahun_ajaran');
        $password       = $this->request->getPost('password');

        // Insert ke tbl_siswa
        $siswaData = [
            'nisn'              => $nisn,
            'nama_siswa'        => $nama_siswa,
            'id_kelas'          => $id_kelas,
            'id_tahun_ajaran'   => $id_tahun_ajaran,
        ];

        $siswaModel->insert($siswaData);

        // Ambil id_siswa terakhir
        $id_siswa = $siswaModel->getInsertID();

        // Insert ke tbl_user
        $userData = [
            'id_siswa'  => $id_siswa,
            'nisn'      => $nisn,
            'email'     => null, // Jika email tidak diinput, bisa diatur null
            'password'  => sha1($password),
            'level'     => 3, // Level siswa
        ];

        $userModel->insert($userData);

        return redirect()->to(base_url('Siswa'))->with('pesan', 'Data siswa berhasil ditambahkan!');
    }

    public function UpdateData($id_siswa)
    {
        $siswaModel = new ModelSiswa();
        $userModel  = new ModelUser();

        $nisn           = $this->request->getPost('nisn');
        $nama_siswa     = $this->request->getPost('nama_siswa');
        $id_kelas       = $this->request->getPost('id_kelas');
        $id_tahun_ajaran= $this->request->getPost('id_tahun_ajaran');
        $password       = $this->request->getPost('password');

        // Update tbl_siswa
        $siswaModel->update($id_siswa, [
            'nisn' => $nisn,
            'nama_siswa' => $nama_siswa,
            'id_kelas' => $id_kelas,
            'id_tahun_ajaran' => $id_tahun_ajaran,
        ]);

        // Siapkan data update untuk tbl_user
        $userUpdate = [
            'nisn' => $nisn,
        ];

        // Jika password tidak kosong, hash dan update
        if (!empty($password)) {
            $userUpdate['password'] = sha1($password);
        }

        // Update berdasarkan id_siswa (foreign key)
        $userModel->where('id_siswa', $id_siswa)->set($userUpdate)->update();

        return redirect()->to(base_url('Siswa'))->with('pesan', 'Data siswa berhasil diupdate!');
    }

    public function DeleteData($id_siswa)
    {
        $userModel  = new ModelUser();
        $siswaModel = new ModelSiswa();

        // Hapus user yang terhubung ke siswa
        $userModel->where('id_siswa', $id_siswa)->delete();

        // Hapus data siswa
        $siswaModel->delete($id_siswa);

        return redirect()->to(base_url('Siswa'))->with('pesan', 'Data siswa berhasil dihapus!');
    }
}
