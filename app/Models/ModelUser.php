<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    protected $table = 'tbl_user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['nama_user', 'id_siswa', 'nisn', 'email', 'password', 'level'];

    public function AllData()
    {
        return $this->db->table('tbl_user')
            ->whereIn('level', [1, 2])
            ->get()
            ->getResultArray();
    }

    public function InsertData($data)
    {
        $this->db->table('tbl_user')->insert($data);
    }

    public function UpdateData($data)
    {
        $this->db->table('tbl_user')
            ->where('id_user', $data['id_user'])
            ->update($data);
    }

    public function DeleteData($data)
    {
        $this->db->table('tbl_user')
            ->where('id_user', $data['id_user'])
            ->delete($data);
    }

    public function LoginUser($email, $password)
    {
        return $this->db->table('tbl_user')
            ->where([
                'email' => $email,
                'password' => $password,
            ])->get()->getRowArray();
    }

    public function LoginOrangTua($nisn, $password)
    {
        return $this->db->table('tbl_user')
            ->where([
                'nisn' => $nisn,
                'password' => $password,
                'level' => 3
            ])->get()->getRowArray();
    }
}
