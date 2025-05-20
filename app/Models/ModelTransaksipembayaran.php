<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTransaksipembayaran extends Model
{
    public function AllData()
    {
        return $this->db->table('tbl_transaksi_pembayaran')
            ->join('tbl_user', 'tbl_user.id_user=tbl_transaksi_pembayaran.id_user')
            ->join('tbl_pembayaran', 'tbl_pembayaran.id_pembayaran=tbl_transaksi_pembayaran.id_pembayaran')
            ->join('tbl_siswa', 'tbl_siswa.id_siswa=tbl_pembayaran.id_siswa')
            ->get()
            ->getResultArray();
    }

    public function InsertData($data)
    {
        $this->db->table('tbl_transaksi_pembayaran')->insert($data);
    }

    public function UpdateData($data)
    {
        $this->db->table('tbl_transaksi_pembayaran')
            ->where('id_transaksi_pembayaran', $data['id_transaksi_pembayaran'])
            ->update($data);
    }

    public function DetailData($id)
    {
        return $this->db->table('tbl_transaksi_pembayaran')
            ->where('id_transaksi_pembayaran', $id)
            ->get()
            ->getRowArray();
    }

    public function DeleteData($data)
    {
        $this->db->table('tbl_transaksi_pembayaran')
            ->where('id_transaksi_pembayaran', $data['id_transaksi_pembayaran'])
            ->delete($data);
    }
}
