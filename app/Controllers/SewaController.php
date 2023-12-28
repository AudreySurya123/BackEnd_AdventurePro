<?php

namespace App\Controllers;

use App\Models\SewaModel;
use CodeIgniter\RESTful\ResourceController;


class SewaController extends ResourceController
{
    protected $format = 'json';

    public function index()
    {
        $sewaModel = new SewaModel();
        $data = $sewaModel->findAll();

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

    public function create()
    {
        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'address' => $this->request->getVar('address'),
            'phone_number' => $this->request->getVar('phone_number'),
            'rental_date' => $this->request->getVar('rental_date'),
            'return_date' => $this->request->getVar('return_date'),
            'notes' => $this->request->getVar('notes'),
            'payment_method' => $this->request->getVar('payment_method'),
        ];

        $sewaModel = new SewaModel();
        $sewaModel->save($data);

        $response = [
            'status' => 'success',
            'message' => 'Data Sewa berhasil ditambahkan',
            'data' => $data,
        ];

        return $this->respond($response);
    }

    public function update($id = null)
    {
        $sewaModel = new SewaModel();
        $sewa = $sewaModel->find($id);
        if ($sewa) {
        $data = [
            'id' => $id,
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'address' => $this->request->getVar('address'),
            'phone_number' => $this->request->getVar('phone_number'),
            'rental_date' => $this->request->getVar('rental_date'),
            'return_date' => $this->request->getVar('return_date'),
            'notes' => $this->request->getVar('notes'),
            'payment_method' => $this->request->getVar('payment_method'),
        ];
        $proses = $sewaModel->save($data);
            if ($proses) {
                $response = [
                    'status' => 200,
                    'messages' => 'Data Sewa berhasil diubah',
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
        return $this->failNotFound('Data Sewa tidak ditemukan');
    }

    public function delete($id = null)
    {
        $sewaModel = new \App\Models\SewaModel();
        $sewa = $sewaModel->find($id);
        if ($sewa) {
            $proses = $sewaModel->delete($id);
            if ($proses) {
                $response = [
                    'status' => 200,
                    'messages' => 'Data Sewa berhasil dihapus',
                ];
            } else {
                $response = [
                    'status' => 402,
                    'messages' => 'Gagal menghapus data',
                ];
            }
            return $this->respond($response);
        } else {
            return $this->failNotFound('Data Sewa tidak ditemukan');
        }
    }
}
