<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table      = 'bookings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id','type','ref_id','pandit_id','slot_date','slot_time','status','amount'];
    protected $useTimestamps  = true;

    public function countForUser(int $userId): int
    {
        return $this->where('user_id', $userId)->countAllResults();
    }

    public function getForUser(int $userId): array
    {
        return $this->where('user_id', $userId)->orderBy('created_at','DESC')->findAll();
    }
}
