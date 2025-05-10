<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSiswa extends Model
{
    protected $table = 'tbl_siswa';
    protected $primaryKey = 'id_siswa';
    protected $allowedFields = ['nisn', 'nama_siswa', 'id_kelas', 'id_tahun_ajaran'];

    public function AllData()
    {
        return $this->db->table('tbl_siswa')
            ->join('tbl_kelas', 'tbl_kelas.id_kelas=tbl_siswa.id_kelas')
            ->join('tbl_tahun_ajaran', 'tbl_tahun_ajaran.id_tahun_ajaran=tbl_siswa.id_tahun_ajaran')
            ->get()
            ->getResultArray();
    }
}
