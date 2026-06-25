<?php

namespace App\Models;

use CodeIgniter\Model;

class PujaModel extends Model
{
    protected $table      = 'pujas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name','slug','icon','vidhi_preview','samagri_included','description_en','description_hi'];
    protected $useTimestamps  = true;

    public function getAll(): array
    {
        return $this->orderBy('id','ASC')->findAll();
    }

    public function getBySlug(string $slug): ?array
    {
        return $this->where('slug', $slug)->first();
    }

    public function getVariants(int $pujaId): array
    {
        return $this->db->table('puja_variants')->where('puja_id', $pujaId)->get()->getResultArray();
    }

    public function search(string $q): array
    {
        return $this->like('name', $q)->findAll(10);
    }
}
