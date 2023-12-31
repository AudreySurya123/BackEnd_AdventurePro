<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class UserController extends ResourceController
{
    use ResponseTrait;
    protected $format = 'json';

    public function index()
    {
        $userModel = new \App\Models\UserModel();
        $data = $userModel->findAll();

        if (!empty($data)) {
            $response = [
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => $data
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'No data found',
                'data' => []
            ];
        }

        return $this->respond($response);
    }

    public function SignUp()
    {
        $data = [
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
        ];

        $userModel = new UserModel();
        $userModel->save($data);

        $response = [
            'status' => 'success',
            'message' => 'Data berhasil ditambahkan',
            'data' => $data,
        ];

        return $this->respond($response);
    }

    public function SignIn()
    {
        $userModel = new UserModel();

        $data = [
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
        ];

        $user = $userModel->where('email', $data['email'])->first();

        if (!$user || $data['password'] != $user->password) {
            // return $this->failUnauthorized('Login Failed, Invalid username or password');
            return $this->respond([
                'code' => 200,
                'status' => 'failed',
                'messages' => 'Akun tidak terdaftar, silahkan buat akun',
                'values' => []
            ]);
        }

        return $this->respond([
            'code' => 200,
            'status' => 'success',
            'message' => 'Login successful',
            'values' => [$user]
        ]);
    }

    public function update($id = null)
    {
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($id);
        if ($user) {
            $data = [
                'id' => $id,
                'nama' => $this->request->getVar('nama'),
                'email' => $this->request->getVar('email'),
                'password' => $this->request->getVar('password'),
            ];
            $proses = $userModel->save($data);
            if ($proses) {
                $response = [
                    'status' => 200,
                    'messages' => 'Data berhasil diubah',
                    'data' => $data
                ];
            } else {
                $response = [
                    'status' => 402,
                    'messages' => 'Gagal diubah',
                ];
            }
            return $this->respond($response);
        }
        return $this->failNotFound('Data tidak ditemukan');
    }

    public function delete($id = null)
    {
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($id);
        if ($user) {
            $proses = $userModel->delete($id);
            if ($proses) {
                $response = [
                    'status' => 200,
                    'messages' => 'Data berhasil dihapus',
                ];
            } else {
                $response = [
                    'status' => 402,
                    'messages' => 'Gagal menghapus data',
                ];
            }
            return $this->respond($response);
        } else {
            return $this->failNotFound('Data tidak ditemukan');
        }
    }
}
