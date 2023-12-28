<?php

namespace App\Controllers;

use App\Models\ProdukTasModel;
use CodeIgniter\RESTful\ResourceController;

class ProdukTasController extends ResourceController
{
    protected $format = 'json';

    public function index()
    {
        $tasModel = new \App\Models\ProdukTasModel();
        $data = $tasModel->findAll();

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

        $tasModel = new \App\Models\ProdukTasModel();
        $proses = $tasModel->save($data);

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
    $tasModel = new \App\Models\ProdukTasModel();
    $tas = $tasModel->find($id);

    if ($tas) {
        $data = [
            'productName' => $this->request->getVar('productName'),
            'productDescription' => $this->request->getVar('productDescription'),
            'productPrice' => $this->request->getVar('productPrice'),
        ];

        $newImage = $this->request->getFile('productImage');

        if ($newImage->isValid() && !$newImage->hasMoved()) {
            // Delete the old image if it exists
            if (!empty($tas['productImage'])) {
                $oldImagePath = WRITEPATH . 'uploads/' . $tas['productImage'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $newName = $newImage->getRandomName();
            $newImage->move(WRITEPATH . 'uploads', $newName);
            $data['productImage'] = $newName;
        } else {
            // If no new image is uploaded, retain the existing image
            $data['productImage'] = $tas['productImage'];
        }

        // Use update method from the model
        $proses = $tasModel->update($id, $data);

        if ($proses) {
            $response = [
                'status' => 200,
                'messages' => 'Data Produk Tas berhasil diubah',
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
        $tasModel = new ProdukTasModel();
        $tas = $tasModel->find($id);

        if ($tas) {
            $proses = $tasModel->delete($id);

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
            return $this->failNotFound('Data Produk Tas tidak ditemukan');
        }
    }
}
