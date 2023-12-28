<?php

namespace App\Controllers;

use App\Models\AdminModel;
use CodeIgniter\RESTful\ResourceController;

class AdminController extends ResourceController
{
    protected $format = 'json';

    public function index()
    {
        $adminModel = new \App\Models\AdminModel();
        $data = $adminModel->findAll();

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

    public function SignIn()
    {
        $adminModel = new AdminModel();

        $data = [
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
        ];

        $admin = $adminModel->where('email', $data['email'])->first();

        if (!$admin || $data['password'] != $admin->password) {
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
            'values' => [$admin]
        ]);
    }

    public function create()
    {
        $data = [
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
        ];

        $userModel = new AdminModel();
        $userModel->save($data);

        $response = [
            'status' => 'success',
            'message' => 'Data berhasil ditambahkan',
            'data' => $data,
        ];

        return $this->respond($response);
    }

    public function update($id = null)
    {
        $adminModel = new \App\Models\AdminModel();
        $admin = $adminModel->find($id);
        if ($admin) {
            $data = [
                'id' => $id,
                'nama' => $this->request->getVar('nama'),
                'email' => $this->request->getVar('email'),
                'password' => $this->request->getVar('password'),
            ];
            $proses = $adminModel->save($data);
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
        $adminModel = new \App\Models\AdminModel();
        $admin = $adminModel->find($id);
        if ($admin) {
            $proses = $adminModel->delete($id);
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



