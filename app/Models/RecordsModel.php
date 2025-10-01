<?php

namespace App\Models;
use CodeIgniter\Model;

class RecordsModel extends Model{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'type', 'name', 'password_hash', 'email', 'password', 'password_hash','role', 'created_at'
    ];


}