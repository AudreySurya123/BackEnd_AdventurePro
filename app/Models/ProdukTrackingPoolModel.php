<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukTrackingPoolModel extends Model
{
    protected $table = 'produk_trackingpool';
    protected $primaryKey = 'id';
    protected $returnType = ProdukTrackingPoolModel::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'productName', 
        'productDescription', 
        'productPrice', 
        'productImage'
    ];
}
