<?php

namespace App\Models;

use CodeIgniter\Model;

class MkModel extends Model
{
    protected $table            = 'mata_kuliah';
    protected $primaryKey       = 'mk_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['matakuliah', 'kelas_id', 'sks'];

    function getAll()
    {
        $builder = $this->db->table('mata_kuliah');
        // $builder->select('matakuliah, nama_kelas, sks, semester');
        $builder->join('kelas', 'kelas.kelas_id = mata_kuliah.kelas_id');
        $query = $builder->get();
        return $query->getResult();
    }
}
