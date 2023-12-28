<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukTendaModel extends Model
{
    protected $table = 'produk_tenda';
    protected $primaryKey = 'id';
    protected $returnType = ProdukTendaModel::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'productName', 
        'productDescription', 
        'productPrice', 
        'productImage'
    ];
}
