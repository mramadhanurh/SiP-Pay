<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKeuangan extends Model
{
    public function JumlahKelas()
    {
        return $this->db->table('tbl_kelas')->countAll();
    }

    public function JumlahSiswa()
    {
        return $this->db->table('tbl_siswa')->countAll();
    }

    public function JumlahPembayaran()
    {
        return $this->db->table('tbl_pembayaran')->countAll();
    }

    public function JumlahUser()
    {
        return $this->db->table('tbl_user')->countAll();
    }
}
