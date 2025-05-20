<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPembayaran extends Model
{
    public function AllData()
    {
        return $this->db->table('tbl_pembayaran')
            ->join('tbl_siswa', 'tbl_siswa.id_siswa=tbl_pembayaran.id_siswa')
            ->join('tbl_tahun_ajaran', 'tbl_tahun_ajaran.id_tahun_ajaran=tbl_pembayaran.id_tahun_ajaran')
            ->get()
            ->getResultArray();
    }

    public function InsertData($data)
    {
        $this->db->table('tbl_pembayaran')->insert($data);
    }

    public function UpdateData($data)
    {
        $this->db->table('tbl_pembayaran')
            ->where('id_pembayaran', $data['id_pembayaran'])
            ->update($data);
    }

    public function DeleteData($data)
    {
        $this->db->table('tbl_pembayaran')
            ->where('id_pembayaran', $data['id_pembayaran'])
            ->delete($data);
    }
}
