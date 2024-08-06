<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsenModel extends Model
{
    protected $table            = 'presensi';
    protected $primaryKey       = 'presensi_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['presensi_id', 'mk_id'];

    function getAll()
    {
        $builder = $this->db->table('presensi');
        $builder->select('created_at, presensi_id, matakuliah, nama_kelas, sks');
        $builder->join('mata_kuliah', 'mata_kuliah.mk_id = presensi.mk_id');
        $builder->join('kelas', 'kelas.kelas_id = mata_kuliah.kelas_id');
        $query = $builder->orderBy('created_at', 'DESC')->get();
        return $query->getResult();
    }
}
