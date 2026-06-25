<?php

namespace App\Models;

use CodeIgniter\Model;

class PujaVariantModel extends Model
{
    protected $table      = 'puja_variants';
    protected $primaryKey = 'id';
    protected $allowedFields = ['puja_id','name','price','duration_minutes','description'];
    protected $useTimestamps  = true;
}
