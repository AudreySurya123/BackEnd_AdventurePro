<?php

namespace App\Controllers;

use App\Models\ProdukTrackingPoolModel;
use CodeIgniter\RESTful\ResourceController;

class ProdukTrackingPoolController extends ResourceController
{
    protected $format = 'json';

    public function index()
    {
        $trackingpoolModel = new \App\Models\ProdukTrackingPoolModel();
        $data = $trackingpoolModel->findAll();

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

    // Tambahkan fungsi untuk mengambil gambar
    public function getImage($filename)
    {
        return $this->response->download(WRITEPATH . 'uploads/' . $filename, null);
    }


    public function create()
    {
        $data = [
            'productName' => $this->request->getVar('productName'),
            'productDescription' => $this->request->getVar('productDescription'),
            'productPrice' => $this->request->getVar('productPrice'),
        ];

        $image = $this->request->getFile('productImage');

        if ($image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move(WRITEPATH . 'uploads', $newName);
            $data['productImage'] = $newName;
        } else {
            $response = [
                'status' => 500,
                'messages' => 'File upload failed',
            ];
            return $this->respond($response);
        }

        $trackingpoolModel = new \App\Models\ProdukTrackingPoolModel();
        $proses = $trackingpoolModel->save($data);

        if ($proses) {
            $response = [
                'status' => 200,
                'messages' => 'Data berhasil ditambahkan',
                'data' => $data,
            ];
        } else {
            $response = [
                'status' => 500,
                'messages' => 'Gagal menambahkan data',
            ];
        }

        return $this->respond($response);
    }

    public function update($id = null)
    {
        $trackingpoolModel = new \App\Models\ProdukTrackingPoolModel();
        $trackingpool = $trackingpoolModel->find($id);

        if ($trackingpool) {
            $data = [
                'id' => $id,
                'productName' => $this->request->getVar('productName'),
                'productDescription' => $this->request->getVar('productDescription'),
                'productPrice' => $this->request->getVar('productPrice'),
            ];

            $newImage = $this->request->getFile('productImage');

            if ($newImage->isValid() && !$newImage->hasMoved()) {
                $newName = $newImage->getRandomName();
                $newImage->move(WRITEPATH . 'uploads', $newName);
                $data['productImage'] = $newName;
            } else {
                $response = [
                    'status' => 500,
                    'messages' => 'File upload failed',
                ];
                return $this->respond($response);
            }

            $proses = $trackingpoolModel->save($data);

            if ($proses) {
                $response = [
                    'status' => 200,
                    'messages' => 'Data Produk Sepatu berhasil diubah',
                    'data' => $data,
                ];
            } else {
                $response = [
                    'status' => 402,
                    'messages' => 'Gagal diubah',
                ];
            }

            return $this->respond($response);
        }

        return $this->failNotFound('Data Produk Tas tidak ditemukan');
    }

    public function delete($id = null)
    {
        $trackingpoolModel = new ProdukTrackingPoolModel();
        $trackingpool = $trackingpoolModel->find($id);

        if ($trackingpool) {
            $proses = $trackingpoolModel->delete($id);

            if ($proses) {
                $response = [
                    'status' => 200,
                    'messages' => 'Data Produk Tas berhasil dihapus',
                ];
            } else {
                $response = [
                    'status' => 402,
                    'messages' => 'Gagal menghapus data',
                ];
            }

            return $this->respond($response);
        } else {
            return $this->failNotFound('Data Produk Sepatu tidak ditemukan');
        }
    }
}
