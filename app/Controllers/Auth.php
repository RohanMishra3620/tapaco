<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        if (session()->get('user_id')) return redirect()->to(base_url('account'));
        return view('auth/login', ['title' => 'Login']);
    }

    public function sendOtp()
    {
        $phone = $this->request->getPost('phone');
        if (!preg_match('/^[6-9]\d{9}$/', $phone)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid phone number']);
        }

        $otp = rand(100000, 999999);
        $model = new UserModel();
        $model->upsertOtp($phone, $otp);

        // In production: integrate SMS gateway here
        // For dev, log the OTP
        log_message('info', "OTP for {$phone}: {$otp}");

        session()->set('otp_phone', $phone);
        return $this->response->setJSON(['success' => true, 'dev_otp' => ENVIRONMENT === 'development' ? $otp : null]);
    }

    public function verifyOtp()
    {
        $phone = session()->get('otp_phone');
        $otp   = $this->request->getPost('otp');

        $model = new UserModel();
        $user  = $model->verifyOtp($phone, $otp);

        if (!$user) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid or expired OTP']);
        }

        session()->set([
            'user_id'    => $user['id'],
            'user_name'  => $user['name'] ?? 'Devotee',
            'user_phone' => $phone,
            'subscribed' => !empty($user['subscribed']),
        ]);

        $redirect = session()->getFlashdata('redirect_after_login') ?? base_url('account');
        return $this->response->setJSON(['success' => true, 'redirect' => $redirect]);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}
