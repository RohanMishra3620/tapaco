<?php

namespace App\Controllers;

use App\Models\MandaliModel;
use App\Models\BookingModel;

class BhajanMandali extends BaseController
{
    public function index()
    {
        $model = new MandaliModel();
        return view('bhajan-mandali/landing', [
            'title'   => 'Bhajan Mandali',
            'mandalis'=> $model->getAll(),
        ]);
    }

    public function detail(string $slug)
    {
        $model  = new MandaliModel();
        $mandali = $model->getBySlug($slug);
        if (!$mandali) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        return view('bhajan-mandali/detail', [
            'title'   => $mandali['name'],
            'mandali' => $mandali,
        ]);
    }

    public function book(string $slug)
    {
        if (!session()->get('user_id')) {
            session()->setFlashdata('redirect_after_login', current_url());
            return $this->response->setJSON(['redirect' => base_url('login')]);
        }

        $model   = new MandaliModel();
        $mandali = $model->getBySlug($slug);

        $bookModel = new BookingModel();
        $id = $bookModel->insert([
            'user_id'   => session()->get('user_id'),
            'type'      => 'mandali',
            'ref_id'    => $mandali['id'],
            'slot_date' => $this->request->getPost('date'),
            'slot_time' => null,
            'status'    => 'pending',
            'amount'    => 0,
        ]);

        return $this->response->setJSON(['success' => true, 'redirect' => base_url("bhajan-mandali/confirmed/{$id}")]);
    }

    public function confirmed(int $id)
    {
        $booking = (new BookingModel())->find($id);
        return view('bhajan-mandali/confirmed', [
            'title'   => 'Request Submitted',
            'booking' => $booking,
        ]);
    }
}
