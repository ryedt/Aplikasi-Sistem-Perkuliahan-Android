<?php

namespace App\Controllers;

use App\Models\AbsenModel;
use App\Models\UserAbsen;
use CodeIgniter\RESTful\ResourceController;

class Presensi extends ResourceController
{
    protected $absen;
    protected $presensi;

    public function __construct()
    {
        $this->absen = new UserAbsen();
        $this->presensi = new AbsenModel();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data = [
            'message' => 'success',
            'data' => $this->absen->getAll()
        ];

        return $this->respond($data, 200);
    }

    public function presen()
    {

        $data = [
            'message' => 'success',
            'data' => $this->presensi->orderBy('presensi.created_at', 'DESC')->getAll(),

        ];

        return $this->respond($data, 200);
    }


    public function new()
    {
        helper('text'); // Memuat helper text untuk menggunakan random_string

        $rules = $this->validate([
            'mk_id' => 'required',
        ]);

        if (!$rules) {
            $response = [
                'message' => $this->validator->getErrors()
            ];
            return $this->failValidationErrors($response);
        }

        $data = [
            'presensi_id' => random_string('alnum', 10), // Panjang 10 karakter, sesuaikan dengan kebutuhan
            'mk_id' => esc($this->request->getVar('mk_id')),
        ];

        $this->presensi->insert($data);

        $response = [
            'status' => true,
            'message' => 'Data berhasil ditambahkan',
        ];

        return $this->respond($response, 200);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $rules = $this->validate([
            'user_id' => 'required',
            'presensi_id' => 'required',
        ]);

        if (!$rules) {
            $response = [
                'message' => $this->validator->getErrors()
            ];
            return $this->failValidationErrors($response);
        }

        $user_id = esc($this->request->getVar('user_id'));
        $presensi_id = esc($this->request->getVar('presensi_id'));

        // Check if the combination of user_id and presensi_id already exists
        $existingRecord = $this->absen->where(['user_id' => $user_id, 'presensi_id' => $presensi_id])->first();

        if ($existingRecord) {
            // If the combination already exists, return an error response
            $response = [
                'status' => false,
                'message' => 'Anda sudah melakukan Absensi',
            ];

            return $this->respond($response, 400);
        }

        $this->absen->insert([
            'user_id' => esc($this->request->getVar('user_id')),
            'presensi_id' => esc($this->request->getVar('presensi_id')),
        ]);

        $response = [
            'status' => true,
            'message' => 'Absensi berhasil',
        ];

        return $this->respond($response, 200);
    }
    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */

    public function delete($id = null)
    {
        //
    }
}
