<?php

namespace App\Models;

use CodeIgniter\Model;

class PanchangModel extends Model
{
    protected $table      = 'panchangs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['date','tithi','paksha','nakshatra','sunrise_time','yoga','karana'];
    protected $useTimestamps  = true;

    public function getToday(): ?array
    {
        return $this->where('date', date('Y-m-d'))->first()
            ?? ['tithi'=>'Ekadashi','paksha'=>'Shukla','nakshatra'=>'Rohini','sunrise_time'=>'6:02 AM'];
    }
}
