<?php

namespace App\Controllers;

use App\Models\RitualGuideModel;
use App\Models\RitualKitModel;

class RitualGuides extends BaseController
{
    public function index()
    {
        $sub   = $this->request->getGet('sub') ?? 'festive-pujans';
        $model = new RitualGuideModel();
        $tabs  = [
            ['slug'=>'festive-pujans',    'label'=>'Festive Pujans'],
            ['slug'=>'all-year-pujans',   'label'=>'All-year Pujans'],
            ['slug'=>'navagraha-pujans',  'label'=>'Navagraha Pujans'],
        ];

        return view('ritual-guides/landing', [
            'title'  => 'Ritual Guides',
            'tabs'   => $tabs,
            'active' => $sub,
            'guides' => $model->getBySubcategory($sub),
        ]);
    }

    public function article(string $slug)
    {
        $model = new RitualGuideModel();
        $guide = $model->getBySlug($slug);
        if (!$guide) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        $lang = $this->request->getGet('lang') ?? session()->get('lang') ?? 'en';

        return view('ritual-guides/article', [
            'title'   => $guide['title'],
            'guide'   => $guide,
            'lang'    => $lang,
            'saved'   => session()->get('user_id')
                            ? (new RitualGuideModel())->isSaved(session()->get('user_id'), $guide['id'])
                            : false,
        ]);
    }

    public function kitCheckout(string $slug)
    {
        $guide = (new RitualGuideModel())->getBySlug($slug);
        $kit   = $guide ? (new RitualKitModel())->find($guide['kit_id'] ?? 0) : null;

        return view('ritual-guides/kit-checkout', [
            'title' => 'Buy Ritual Kit',
            'guide' => $guide,
            'kit'   => $kit,
        ]);
    }

    public function kitPlace(string $slug)
    {
        if (!session()->get('user_id')) {
            session()->setFlashdata('redirect_after_login', current_url());
            return $this->response->setJSON(['redirect' => base_url('login')]);
        }
        // Persist order — placeholder for payment gateway integration
        return $this->response->setJSON(['success' => true, 'message' => 'Order placed']);
    }

    public function save(int $id)
    {
        if (!session()->get('user_id')) {
            return $this->response->setJSON(['success' => false, 'redirect' => base_url('login')]);
        }
        $model  = new RitualGuideModel();
        $saved  = $model->toggleSave(session()->get('user_id'), $id);
        return $this->response->setJSON(['success' => true, 'saved' => $saved]);
    }
}
