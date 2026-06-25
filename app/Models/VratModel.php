<?php

namespace App\Models;

use CodeIgniter\Model;

class VratModel extends Model
{
    protected $table      = 'vrat_calendar';
    protected $primaryKey = 'id';
    protected $allowedFields = ['vrat_name','slug','date','type','description'];
    protected $useTimestamps  = true;

    public function getUpcoming(int $limit = 5): array
    {
        return $this->where('date >=', date('Y-m-d'))->orderBy('date','ASC')->findAll($limit);
    }

    public function getAll(string $filter = 'all'): array
    {
        $q = $this->where('date >=', date('Y-m-d'))->orderBy('date','ASC');
        if ($filter !== 'all') $q = $q->where('type', $filter);
        return $q->findAll();
    }

    public function getBySlug(string $slug): ?array
    {
        return $this->where('slug', $slug)->first();
    }
}
