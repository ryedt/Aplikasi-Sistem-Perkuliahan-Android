<?php

namespace App\Models;

use CodeIgniter\Model;

class KrsModel extends Model
{
    protected $table            = 'krs';
    protected $primaryKey       = 'krs_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['krs_id', 'user_id', 'mk_id', 'kelas_id', 'nilai'];

    function getAll()
    {
        $builder = $this->db->table('krs');
        $builder->select('krs_id, krs.user_id, fullname, nim, level, matakuliah, sks, nama_kelas, semester, nilai');
        $builder->join('users', 'users.user_id = krs.user_id');
        $builder->join('mata_kuliah', 'mata_kuliah.mk_id = krs.mk_id');
        $builder->join('kelas', 'kelas.kelas_id = krs.kelas_id');
        $query = $builder->get();
        return $query->getResult();
    }

    // KrsModel.php
    public function getDataByUserId($user_id)
    {
        $builder = $this->db->table('krs');
        $builder->select('mata_kuliah.matakuliah, sks, nilai');
        $builder->join('mata_kuliah', 'mata_kuliah.mk_id = krs.mk_id');
        $builder->where('user_id', $user_id);
        $query = $builder->get();
        return $query->getResultArray(); // Menggunakan getResultArray agar mengembalikan array asosiatif
    }
}
