<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\KrsModel;
use App\Models\MkModel;

class Krs extends ResourceController
{
    protected $krsModel;
    protected $mkModel;

    public function __construct()
    {
        $this->krsModel = new KrsModel();
        $this->mkModel = new MkModel();
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
            'data' => $this->krsModel->getAll()
        ];

        return $this->respond($data, 200);
    }


    public function create()
    {
        $userid = $this->request->getVar('user_id');
        $matkul = $this->request->getVar('mk_id');

        $mkmk = new KrsModel();

        // Cek apakah user_id sudah ada dalam database
        $cek = $mkmk->where('user_id', $userid)->first();

        if ($cek) {
            // Jika user_id sudah ada, cek apakah mk_id sudah dipilih sebelumnya
            $existingMkId = $mkmk->where('user_id', $userid)->where('mk_id', $matkul)->first();

            if ($existingMkId) {
                // Jika mk_id sudah dipilih, berikan respons error
                return $this->respond(['status' => false, 'message' => 'Matkul sudah dipilih'], 404);
            }

            // Jika mk_id tidak sama dengan yang sudah dipilih, lakukan pengecekan untuk memastikan bahwa user_id dan mk_id unik
            $this->krsModel->insert([
                'user_id' => esc($userid),
                'mk_id' => esc($matkul),
                'kelas_id' => esc($this->request->getVar('kelas_id')),
            ]);

            $response = [
                'status' => true,
                'message' => 'Data berhasil ditambahkan',
            ];

            return $this->respond($response, 200);
        } else {
            // Jika user_id tidak ada, langsung lakukan penyisipan data ke dalam database
            $this->krsModel->insert([
                'user_id' => esc($userid),
                'mk_id' => esc($matkul),
                'kelas_id' => esc($this->request->getVar('kelas_id')),
            ]);

            $response = [
                'status' => true,
                'message' => 'Data berhasil ditambahkan',
            ];

            return $this->respond($response, 200);
        }
    }


    public function update($id = 'krs_id')
    {

        $this->krsModel->update($id, [
            'nilai' => esc($this->request->getRawInputVar('nilai'))
        ]);

        $response = [
            'message' => 'Nilai berhasil diubah.'
        ];

        return $this->respond($response, 200);
    }


    public function delete($id = 'krs_id')
    {
        $this->krsModel->delete($id);

        $response = [
            'message' => 'Data berhasil dihapus.'
        ];

        return $this->respondDeleted($response);
    }
}
