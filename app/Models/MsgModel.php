<?php

namespace App\Models;

use CodeIgniter\Model;

class MsgModel extends Model
{
    protected $table = 'msg';
    protected $primaryKey = 'id';
    protected $returnType = MsgModel::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'nama',
        'email',
        'pesan'
    ];
}