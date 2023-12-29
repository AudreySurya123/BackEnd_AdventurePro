<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id';
    protected $returnType = ProdukModel::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'productName', 
        'productDescription', 
        'productPrice', 
        'productImage'
    ];
}
