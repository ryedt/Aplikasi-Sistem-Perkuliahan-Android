<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;
use Firebase\JWT\JWT;

class UserApi extends ResourceController
{
    protected $format = 'json';
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function login()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $selectedLevel = $this->request->getVar('level');

        $userModel = new UserModel;

        $user = $userModel->where('email', $email)->first();
        if (!$user) {
            return $this->respond(['status' => false, 'message' => 'Email Not Found'], 404);
        }

        if ($password !== $user['password']) {
            // if (!password_verify($password, $user['password'])) {
            return $this->respond(['status' => false, 'message' => 'Wrong Password'], 400);
        }

        $userLevel = $user['level'];

        // Cek apakah tingkat yang dipilih sesuai dengan tingkat di database
        if ($selectedLevel && strtolower($selectedLevel) !== strtolower($userLevel)) {
            return $this->respond(['status' => false, 'message' => 'Invalid User Level'], 403);
        }
        $key = getenv("TOKEN_SECRET");

        $iat = time();
        $exp = $iat + (60 * 60);

        $payload = [
            'iss' => 'ci4-rest',
            'sub' => 'logintoken',
            'iat' => $iat,
            'exp' => $exp,
            'email' => $email
        ];

        $token = JWT::encode($payload, $key, "HS256");

        $id = $user['user_id'];
        $fullname = $user['fullname'];
        $nim = $user['nim'];
        $alamat = $user['alamat'];
        $jurusan = $user['jurusan'];

        return $this->respond([
            'status' => true,
            'message' => 'Login berhasil',
            'data' => [
                'id' => $id,
                'level' => $userLevel,
                'nama' => $fullname,
                'nim' => $nim,
                'alamat' => $alamat,
                'jurusan' => $jurusan
            ],
            'token' => $token
        ]);
    }

    public function regist()
    {
        $model = new UserModel();

        $rules = [
            'fullname' => 'required',
            'jurusan' => 'required',
            'nim' => 'required|is_unique[users.nim]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
        ];
        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());

        $confirm = $this->validate(['confpassword' => 'required|matches[password]']);
        if (!$confirm) return $this->respond(['confpassword' => 'Konfirmasi password tidak valid'], 403);


        $data = [
            'fullname' => $this->request->getVar('fullname'),
            'nim' => $this->request->getVar('nim'),
            'jurusan' => $this->request->getVar('jurusan'),
            'alamat' => $this->request->getVar('alamat'),
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
            // 'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT)
        ];
        $model->save($data);

        $response = [
            'status' => true,
            'message' => 'Registrasi berhasil.',
        ];

        return $this->respond($response, 200);
    }

    public function tampil()
    {
        $tampilUser = new UserModel();

        $data = [
            'message' => 'success',
            'data' => $tampilUser->findAll()
        ];

        return $this->respond($data, 200);
    }
}
