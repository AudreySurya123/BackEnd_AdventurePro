<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukSepatuModel extends Model
{
    protected $table = 'produk_sepatu';
    protected $primaryKey = 'id';
    protected $returnType = ProdukSepatuModel::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'productName', 
        'productDescription', 
        'productPrice', 
        'productImage'
    ];
}
