<?php

namespace App\Models;

use CodeIgniter\Model;

class UserAbsen extends Model
{
    protected $table            = 'absen';
    protected $primaryKey       = 'absen_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['presensi_id', 'user_id'];

    function getAll()
    {
        $builder = $this->db->table('absen');
        $builder->select('absen_id, presensi.presensi_id, users.user_id, matakuliah, nama_kelas, sks, fullname, tanggal, kehadiran');
        $builder->join('users', 'users.user_id = absen.user_id');
        $builder->join('presensi', 'presensi.presensi_id = absen.presensi_id');
        $builder->join('mata_kuliah', 'mata_kuliah.mk_id = presensi.mk_id');
        $builder->join('kelas', 'kelas.kelas_id = mata_kuliah.kelas_id');
        $query = $builder->get();
        return $query->getResult();
    }
}
