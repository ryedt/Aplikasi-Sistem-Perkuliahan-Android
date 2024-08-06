<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class MahasiswaController extends ResourceController
{
    protected $modelName = 'App\Models\Mahasiswa';
    protected $format = 'json';
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data = [
            'message' => 'success',
            'data_mahasiswa' => $this->model->findAll()
        ];

        return $this->respond($data, 200);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $data = [
            'message' => 'success',
            'data_byid' => $this->model->find($id)
        ];

        if ($data['data_byid'] == null) {
            return $this->failNotFound('Data pegawai tidak ditemukan.');
        };

        return $this->respond($data, 200);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $rules = $this->validate([
            'nim' => 'required',
            'nama' => 'required',
            'jabatan' => 'required',
            'prodi' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'gambar' => 'uploaded[gambar]|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]'
        ]);

        if (!$rules) {
            $response = [
                'message' => $this->validator->getErrors()
            ];
            return $this->failValidationErrors($response);
        }
        //proses upload
        $gambar = $this->request->getFile('gambar');
        $namaGambar = $gambar->getRandomName();
        $gambar->move('gambar', $namaGambar);

        $this->model->insert([
            'nim' => esc($this->request->getVar('nim')),
            'nama' => esc($this->request->getVar('nama')),
            'jabatan' => esc($this->request->getVar('jabatan')),
            'prodi' => esc($this->request->getVar('prodi')),
            'alamat' => esc($this->request->getVar('alamat')),
            'email' => esc($this->request->getVar('email')),
            'gambar' => $namaGambar
        ]);

        $response = [
            'message' => 'Data berhasil ditambah.'
        ];

        return $this->respondCreated($response);
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $rules = $this->validate([
            'nim' => 'required',
            'nama' => 'required',
            'jabatan' => 'required',
            'prodi' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'gambar' => 'max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]'
        ]);


        if (!$rules) {
            $response = [
                'message' => $this->validator->getErrors()
            ];
            return $this->failValidationErrors($response);
        }

        //proses upload
        $gambar = $this->request->getFile('gambar');

        if ($gambar) {
            $namaGambar = $gambar->getRandomName();
            $gambar->move('gambar', $namaGambar);

            $gambarDb = $this->model->find($id);
            if ($gambarDb['gambar'] == $this->request->getPost('gambarLama')) {
                unlink('gambar/' . $this->request->getPost('gambarLama'));
            }
        } else {
            $namaGambar = $this->request->getPost('gambarLama');
        }


        $this->model->update($id, [
            'nim' => esc($this->request->getVar('nim')),
            'nama' => esc($this->request->getVar('nama')),
            'jabatan' => esc($this->request->getVar('jabatan')),
            'prodi' => esc($this->request->getVar('prodi')),
            'alamat' => esc($this->request->getVar('alamat')),
            'email' => esc($this->request->getVar('email')),
            'gambar' => $namaGambar
        ]);

        $response = [
            'message' => 'Data berhasil diubah.'
        ];

        return $this->respond($response, 200);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $gambarDb = $this->model->find($id);
        if ($gambarDb['gambar'] != '') {
            unlink('gambar/' . $gambarDb['gambar']);
        }

        $this->model->delete($id);

        $response = [
            'message' => 'Data berhasil dihapus.'
        ];

        return $this->respondDeleted($response);
    }
}
