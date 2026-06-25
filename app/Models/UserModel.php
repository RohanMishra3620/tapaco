<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['phone', 'name', 'otp', 'otp_expires_at', 'verified', 'lang_pref'];
    protected $useTimestamps = true;

    public function upsertOtp(string $phone, int $otp): void
    {
        $expires = date('Y-m-d H:i:s', time() + 300);
        $exists  = $this->where('phone', $phone)->first();

        if ($exists) {
            $this->where('phone', $phone)->set(['otp' => $otp, 'otp_expires_at' => $expires])->update();
        } else {
            $this->insert(['phone' => $phone, 'otp' => $otp, 'otp_expires_at' => $expires, 'verified' => 0]);
        }
    }

    public function verifyOtp(string $phone, string $otp): ?array
    {
        $user = $this->where('phone', $phone)
                     ->where('otp', $otp)
                     ->where('otp_expires_at >', date('Y-m-d H:i:s'))
                     ->first();
        if ($user) {
            $this->where('phone', $phone)->set(['verified' => 1, 'otp' => null])->update();
        }
        return $user;
    }
}
