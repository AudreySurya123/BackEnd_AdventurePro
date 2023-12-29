<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use CodeIgniter\RESTful\ResourceController;

class ProdukController extends ResourceController
{
    protected $format = 'json';

    public function index()
    {
        $produkModel = new \App\Models\ProdukModel();
        $data = $produkModel->findAll();

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

    public function show($id = null)
    {
        $produkModel = new \App\Models\ProdukModel();
        $produk = $produkModel->find($id);

        if ($produk) {
            $response = [
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => $produk,
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Data not found',
                'data' => [],
            ];
        }

        return $this->respond($response);
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

        $produkModel = new \App\Models\ProdukModel();
        $proses = $produkModel->save($data);

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
    $produkModel = new \App\Models\ProdukModel();
    $produk = $produkModel->find($id);

    if ($produk) {
        $data = [
            'productName' => $this->request->getVar('productName'),
            'productDescription' => $this->request->getVar('productDescription'),
            'productPrice' => $this->request->getVar('productPrice'),
        ];

        $newImage = $this->request->getFile('productImage');

        if ($newImage->isValid() && !$newImage->hasMoved()) {
            // Delete the old image if it exists
            if (!empty($produk['productImage'])) {
                $oldImagePath = WRITEPATH . 'uploads/' . $produk['productImage'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $newName = $newImage->getRandomName();
            $newImage->move(WRITEPATH . 'uploads', $newName);
            $data['productImage'] = $newName;
        } else {
            // If no new image is uploaded, retain the existing image
            $data['productImage'] = $produk['productImage'];
        }

        // Use update method from the model
        $proses = $produkModel->update($id, $data);

        if ($proses) {
            $response = [
                'status' => 200,
                'messages' => 'Data Produk produk berhasil diubah',
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

    return $this->failNotFound('Data Produk produk tidak ditemukan');
}

    public function delete($id = null)
    {
        $produkModel = new ProdukModel();
        $produk = $produkModel->find($id);

        if ($produk) {
            $proses = $produkModel->delete($id);

            if ($proses) {
                $response = [
                    'status' => 200,
                    'messages' => 'Data Produk produk berhasil dihapus',
                ];
            } else {
                $response = [
                    'status' => 402,
                    'messages' => 'Gagal menghapus data',
                ];
            }

            return $this->respond($response);
        } else {
            return $this->failNotFound('Data Produk produk tidak ditemukan');
        }
    }
}
