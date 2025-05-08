<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTahunajaran extends Model
{
    public function AllData()
    {
        return $this->db->table('tbl_tahun_ajaran')
            ->get()
            ->getResultArray();
    }

    public function InsertData($data)
    {
        $this->db->table('tbl_tahun_ajaran')->insert($data);
    }

    public function UpdateData($data)
    {
        $this->db->table('tbl_tahun_ajaran')
            ->where('id_tahun_ajaran', $data['id_tahun_ajaran'])
            ->update($data);
    }

    public function DeleteData($data)
    {
        $this->db->table('tbl_tahun_ajaran')
            ->where('id_tahun_ajaran', $data['id_tahun_ajaran'])
            ->delete($data);
    }
}
