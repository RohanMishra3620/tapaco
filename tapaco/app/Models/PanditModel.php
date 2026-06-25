<?php

namespace App\Models;

use CodeIgniter\Model;

class PanditModel extends Model
{
    protected $table      = 'pandits';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name','rating','languages_spoken','photo_url','experience_years','bio'];
    protected $useTimestamps  = true;

    public function getAvailable(): array
    {
        return $this->orderBy('rating','DESC')->findAll();
    }
}
