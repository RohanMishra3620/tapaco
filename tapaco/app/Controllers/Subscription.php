<?php

namespace App\Controllers;

use App\Models\SubscriptionModel;

class Subscription extends BaseController
{
    public function index()
    {
        $placement = $this->request->getGet('from') ?? 'general';
        return view('subscription/optin', [
            'title'     => 'WhatsApp Subscription',
            'placement' => $placement,
        ]);
    }

    public function pay()
    {
        if (!session()->get('user_id')) {
            session()->setFlashdata('redirect_after_login', base_url('subscribe'));
            return redirect()->to(base_url('login'));
        }

        $method  = $this->request->getPost('method') ?? 'upi';
        $whatsapp= $this->request->getPost('whatsapp_number');

        return view('subscription/payment', [
            'title'    => 'Complete Payment',
            'method'   => $method,
            'whatsapp' => $whatsapp,
            'amount'   => 99,
        ]);
    }

    public function success()
    {
        $userId = session()->get('user_id');
        if (!$userId) return redirect()->to(base_url('/'));

        $model = new SubscriptionModel();
        $exists = $model->activeForUser($userId);

        if (!$exists) {
            $model->insert([
                'user_id'        => $userId,
                'phone'          => session()->get('user_phone'),
                'amount'         => 99,
                'starts_at'      => date('Y-m-d'),
                'expires_at'     => date('Y-m-d', strtotime('+1 year')),
                'status'         => 'active',
                'whatsapp_number'=> session()->getFlashdata('whatsapp_number') ?? session()->get('user_phone'),
            ]);
            session()->set('subscribed', true);
        }

        return view('subscription/success', [
            'title'      => 'Subscribed!',
            'expires_at' => date('d M Y', strtotime('+1 year')),
        ]);
    }
}
