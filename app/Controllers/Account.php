<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\BookingModel;
use App\Models\SubscriptionModel;
use App\Models\RitualGuideModel;
use App\Models\PujaModel;
use App\Models\MandaliModel;

class Account extends BaseController
{
    private function requireLogin(): bool
    {
        if (!session()->get('user_id')) {
            session()->setFlashdata('redirect_after_login', current_url());
            redirect()->to(base_url('login'))->send();
            return false;
        }
        return true;
    }

    public function index()
    {
        if (!$this->requireLogin()) return;
        $userId = session()->get('user_id');

        $savedCount   = (new RitualGuideModel())->savedCount($userId);
        $bookingCount = (new BookingModel())->countForUser($userId);
        $subStatus    = (new SubscriptionModel())->activeForUser($userId);

        $userModel = new UserModel();
        $user = $userModel->find($userId);

        return view('account/profile', [
            'title'        => 'My Account',
            'user'         => $user,
            'savedCount'   => $savedCount,
            'bookingCount' => $bookingCount,
            'subStatus'    => $subStatus,
        ]);
    }

    public function saved()
    {
        if (!$this->requireLogin()) return;
        $userId = session()->get('user_id');

        $db   = \Config\Database::connect();
        $rows = $db->table('saved_rituals sr')
                   ->select('rg.id, rg.title, rg.slug, rg.tag, rg.subcategory, rg.confidence_score, sr.created_at as saved_at')
                   ->join('ritual_guides rg', 'rg.id = sr.ritual_guide_id')
                   ->where('sr.user_id', $userId)
                   ->orderBy('sr.created_at', 'DESC')
                   ->get()->getResultArray();

        return view('account/saved', [
            'title' => 'Saved Rituals',
            'saved' => $rows,
        ]);
    }

    public function bookings()
    {
        if (!$this->requireLogin()) return;
        $userId   = session()->get('user_id');
        $bookings = (new BookingModel())->getForUser($userId);

        $pujaModel    = new PujaModel();
        $mandaliModel = new MandaliModel();

        foreach ($bookings as &$b) {
            if ($b['type'] === 'puja') {
                $ref = $pujaModel->find($b['ref_id']);
                $b['ref_name'] = $ref['name'] ?? 'Puja';
                $b['ref_icon'] = $ref['icon'] ?? '🛕';
            } elseif ($b['type'] === 'mandali') {
                $ref = $mandaliModel->find($b['ref_id']);
                $b['ref_name'] = $ref['name'] ?? 'Mandali';
                $b['ref_icon'] = $ref['icon'] ?? '🎶';
            } else {
                $b['ref_name'] = 'Ritual Kit';
                $b['ref_icon'] = '🛒';
            }
        }

        return view('account/bookings', [
            'title'    => 'Booking History',
            'bookings' => $bookings,
        ]);
    }

    public function subscriptions()
    {
        if (!$this->requireLogin()) return;
        $userId = session()->get('user_id');
        $sub    = (new SubscriptionModel())->activeForUser($userId);

        return view('account/subscriptions', [
            'title' => 'My Subscriptions',
            'sub'   => $sub,
        ]);
    }

    public function language()
    {
        if (!$this->requireLogin()) return;
        $userId = session()->get('user_id');
        $user   = (new UserModel())->find($userId);

        return view('account/language', [
            'title'    => 'Language Preferences',
            'current'  => $user['lang_pref'] ?? 'en',
        ]);
    }

    public function saveLanguage()
    {
        if (!$this->requireLogin()) return;
        $lang   = $this->request->getPost('lang');
        $userId = session()->get('user_id');

        if (in_array($lang, ['en', 'hi'])) {
            (new UserModel())->update($userId, ['lang_pref' => $lang]);
            session()->set('lang', $lang);
        }

        return redirect()->to(base_url('account/language'))->with('success', 'Language updated');
    }

    public function notifications()
    {
        if (!$this->requireLogin()) return;
        $userId = session()->get('user_id');
        $prefs  = session()->get('notif_prefs') ?? [
            'vrat_reminders'  => true,
            'puja_reminders'  => true,
            'offers'          => false,
            'daily_panchang'  => true,
        ];

        return view('account/notifications', [
            'title' => 'Notification Preferences',
            'prefs' => $prefs,
        ]);
    }

    public function saveNotifications()
    {
        if (!$this->requireLogin()) return;
        $prefs = [
            'vrat_reminders' => (bool) $this->request->getPost('vrat_reminders'),
            'puja_reminders' => (bool) $this->request->getPost('puja_reminders'),
            'offers'         => (bool) $this->request->getPost('offers'),
            'daily_panchang' => (bool) $this->request->getPost('daily_panchang'),
        ];
        session()->set('notif_prefs', $prefs);

        return redirect()->to(base_url('account/notifications'))->with('success', 'Preferences saved');
    }
}
