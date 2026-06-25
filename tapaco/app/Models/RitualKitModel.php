<?php

namespace App\Models;

use CodeIgniter\Model;

class RitualKitModel extends Model
{
    protected $table      = 'ritual_kits';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name','sku','contents_json','price','image_url'];
    protected $useTimestamps  = true;
}
