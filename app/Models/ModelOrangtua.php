<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelOrangtua extends Model
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

    public function JumlahTransaksiPembayaran()
    {
        return $this->db->table('tbl_transaksi_pembayaran')->countAll();
    }
}
