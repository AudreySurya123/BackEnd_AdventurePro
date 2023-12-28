<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukTasModel extends Model
{
    protected $table = 'produk_tas';
    protected $primaryKey = 'id';
    protected $returnType = ProdukTasModel::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'productName', 
        'productDescription', 
        'productPrice', 
        'productImage'
    ];
}
