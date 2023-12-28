<?php

namespace App\Models;

use CodeIgniter\Model;

class SewaModel extends Model
{
    protected $table = 'sewa';
    protected $primaryKey = 'id';
    protected $returnType = MsgModel::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'name', 
        'email', 
        'address', 
        'phone_number', 
        'rental_date', 
        'return_date', 
        'notes', 
        'payment_method'
    ];
}