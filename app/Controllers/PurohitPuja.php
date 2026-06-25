<?php

namespace App\Controllers;

use App\Models\PujaModel;
use App\Models\PanditModel;
use App\Models\BookingModel;

class PurohitPuja extends BaseController
{
    public function index()
    {
        $model = new PujaModel();
        return view('purohit-puja/landing', [
            'title' => 'Purohit & Puja',
            'pujas' => $model->getAll(),
        ]);
    }

    public function detail(string $slug)
    {
        $pujaModel   = new PujaModel();
        $panditModel = new PanditModel();

        $puja    = $pujaModel->getBySlug($slug);
        if (!$puja) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        $variants = $pujaModel->getVariants($puja['id']);
        $pandits  = $panditModel->getAvailable();

        $lang = $this->request->getGet('lang') ?? 'en';

        return view('purohit-puja/detail', [
            'title'   => $puja['name'],
            'puja'    => $puja,
            'variants'=> $variants,
            'pandits' => $pandits,
            'lang'    => $lang,
        ]);
    }

    public function book(string $slug)
    {
        if (!session()->get('user_id')) {
            session()->setFlashdata('redirect_after_login', current_url());
            return $this->response->setJSON(['redirect' => base_url('login')]);
        }

        $pujaModel = new PujaModel();
        $puja      = $pujaModel->getBySlug($slug);
        $variantId = $this->request->getPost('variant_id');
        $panditId  = $this->request->getPost('pandit_id');
        $date      = $this->request->getPost('date');
        $time      = $this->request->getPost('time');

        $variant  = (new \App\Models\PujaVariantModel())->find($variantId);
        $bookModel = new BookingModel();

        $id = $bookModel->insert([
            'user_id'   => session()->get('user_id'),
            'type'      => 'puja',
            'ref_id'    => $puja['id'],
            'pandit_id' => $panditId,
            'slot_date' => $date,
            'slot_time' => $time,
            'status'    => 'confirmed',
            'amount'    => $variant['price'] ?? 0,
        ]);

        return $this->response->setJSON(['success' => true, 'redirect' => base_url("purohit-puja/confirmed/{$id}")]);
    }

    public function confirmed(int $id)
    {
        $booking = (new BookingModel())->find($id);
        return view('purohit-puja/confirmed', [
            'title'   => 'Booking Confirmed',
            'booking' => $booking,
        ]);
    }
}
