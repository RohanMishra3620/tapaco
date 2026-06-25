<?php

namespace App\Models;

use CodeIgniter\Model;

class SubscriptionModel extends Model
{
    protected $table      = 'subscriptions';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id','phone','amount','starts_at','expires_at','status','whatsapp_number'];
    protected $useTimestamps  = true;

    public function activeForUser(int $userId): ?array
    {
        return $this->where('user_id', $userId)
                    ->where('status', 'active')
                    ->where('expires_at >=', date('Y-m-d'))
                    ->first();
    }
}
