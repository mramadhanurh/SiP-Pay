<?php

namespace App\Controllers;

use App\Models\ModelUser;

class Home extends BaseController
{
    public function __construct()
    {
        $this->ModelUser = new ModelUser();
    }

    public function index()
    {
        $data = [
            'judul' => 'Login',
        ];
        return view('v_login', $data);
    }

    public function CekLogin()
    {
        $level = $this->request->getPost('level');

        $rules = [
            'level' => [
                'label' => 'Level',
                'rules' => 'required|in_list[1,2,3]',
                'errors' => [
                    'required' => '{field} Harus Dipilih!',
                    'in_list' => '{field} tidak valid!',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Masih Kosong!',
                ]
            ]
        ];
    
        // Tambah validasi tergantung level
        if ($level == '3') {
            $rules['nisn'] = [
                'label' => 'NISN',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} Masih Kosong!',
                    'numeric' => '{field} harus berupa angka!',
                ]
            ];
        } else {
            $rules['email'] = [
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} Masih Kosong!',
                    'valid_email' => '{field} tidak valid!',
                ]
            ];
        }
    
        if (!$this->validate($rules)) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Home'))->withInput();
        }
    
        $password = sha1($this->request->getPost('password'));
    
        if ($level == '3') {
            $nisn = $this->request->getPost('nisn');
            $cek_login = $this->ModelUser->LoginOrangTua($nisn, $password);
        } else {
            $email = $this->request->getPost('email');
            $cek_login = $this->ModelUser->LoginUser($email, $password, $level);
        }
    
        if ($cek_login) {
            session()->set('id_user', $cek_login['id_user']);
            session()->set('nama_user', $cek_login['nama_user'] ?? $cek_login['nisn']);
            session()->set('email', $cek_login['email']);
            session()->set('level', $cek_login['level']);
    
            if ($level == '1') {
                return redirect()->to(base_url('Admin/index'));
            } elseif ($level == '2') {
                return redirect()->to(base_url('Keuangan'));
            } else {
                return redirect()->to(base_url('Orangtua'));
            }
        } else {
            // Jika login gagal
            session()->setFlashdata('gagal', 'Email atau Password salah!');
            return redirect()->to(base_url('Home'))->withInput();;
        }
    }

    public function Logout()
    {
        session()->remove('id_user');
        session()->remove('nama_user');
        session()->remove('email');
        session()->remove('level');
        session()->setFlashdata('pesan', 'Anda telah berhasil Logout!');
        return redirect()->to(base_url('Home'));
    }
}
