<?php

namespace App\Controllers;

use App\Models\MsgModel;
use CodeIgniter\RESTful\ResourceController;


class MsgController extends ResourceController
{
    protected $format = 'json';

    public function index()
    {
        $msgModel = new MsgModel();
        $data = $msgModel->findAll();

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
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'pesan' => $this->request->getVar('pesan'),
        ];

        $msgModel = new MsgModel();
        $msgModel->save($data);

        $response = [
            'status' => 'success',
            'message' => 'Message berhasil ditambahkan',
            'data' => $data,
        ];

        return $this->respond($response);
    }

    public function update($id = null)
    {
        $msgModel = new MsgModel();
        $msg = $msgModel->find($id);
        if ($msg) {
        $data = [
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'pesan' => $this->request->getVar('pesan'),
        ];
        $proses = $msgModel->save($data);
            if ($proses) {
                $response = [
                    'status' => 200,
                    'messages' => 'Message berhasil diubah',
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
        return $this->failNotFound('Message tidak ditemukan');
    }

    public function delete($id = null)
    {
        $msgModel = new \App\Models\MsgModel();
        $msg = $msgModel->find($id);
        if ($msg) {
            $proses = $msgModel->delete($id);
            if ($proses) {
                $response = [
                    'status' => 200,
                    'messages' => 'Message berhasil dihapus',
                ];
            } else {
                $response = [
                    'status' => 402,
                    'messages' => 'Gagal menghapus data',
                ];
            }
            return $this->respond($response);
        } else {
            return $this->failNotFound('Message tidak ditemukan');
        }
    }
}
