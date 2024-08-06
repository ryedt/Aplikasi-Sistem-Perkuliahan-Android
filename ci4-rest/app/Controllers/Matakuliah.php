<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\MkModel;
use App\Models\KelasModel;

class Matakuliah extends ResourceController
{
    protected $mkModel;
    protected $kelasModel;

    public function __construct()
    {
        $this->mkModel = new MkModel();
        $this->kelasModel = new KelasModel();
    }

    public function index()
    {
        $data = [
            'message' => 'success',
            'data' => $this->mkModel->getAll()
        ];

        return $this->respond($data, 200);
    }


    public function kelas()
    {
        $data = [
            'message' => 'success',
            'data' => $this->kelasModel->findAll()
        ];

        return $this->respond($data, 200);
    }


    public function create()
    {
        $rules = $this->validate([
            'kelas_id' => 'required',
            'matakuliah' => 'required',
            'sks' => 'required'
        ]);

        if (!$rules) {
            $response = [
                'message' => $this->validator->getErrors()
            ];
            return $this->failValidationErrors($response);
        }
        $this->mkModel->insert([
            'kelas_id' => esc($this->request->getVar('kelas_id')),
            'matakuliah' => esc($this->request->getVar('matakuliah')),
            'sks' => esc($this->request->getVar('sks')),
        ]);

        $response = [
            'status' => true,
            'message' => 'Data berhasil ditambahkan',
        ];

        return $this->respond($response, 200);
    }


    public function delete($id = 'mk_id')
    {

        $this->mkModel->delete($id);

        $response = [
            'message' => 'Data berhasil dihapus.'
        ];

        return $this->respondDeleted($response);
    }
}
