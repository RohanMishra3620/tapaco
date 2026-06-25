<?php

namespace App\Models;

use CodeIgniter\Model;

class MandaliModel extends Model
{
    protected $table      = 'mandali_types';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name','slug','icon','description','starting_price'];
    protected $useTimestamps  = true;

    public function getAll(): array
    {
        return $this->orderBy('id','ASC')->findAll();
    }

    public function getBySlug(string $slug): ?array
    {
        return $this->where('slug', $slug)->first();
    }
}
