<?php

namespace App\Controllers;

use App\Models\PanchangModel;
use App\Models\VratModel;

class Panchang extends BaseController
{
    public function index()
    {
        $model  = new PanchangModel();
        $vrat   = new VratModel();
        $today  = $model->getToday();
        $upcoming = $vrat->getUpcoming(3);

        return view('panchang/landing', [
            'title'    => 'Panchang',
            'today'    => $today,
            'upcoming' => $upcoming,
            'subcats'  => [
                ['icon'=>'☀️',  'label'=>"Today's Panchang", 'href'=>'panchang#today'],
                ['icon'=>'🌙', 'label'=>'Vrat Calendar',    'href'=>'panchang/vrat'],
                ['icon'=>'🎊', 'label'=>'Festival Dates',   'href'=>'panchang/vrat?type=festival'],
                ['icon'=>'⭐', 'label'=>'Nakshatra Guide',  'href'=>'panchang#nakshatra'],
            ],
        ]);
    }

    public function vratList()
    {
        $model  = new VratModel();
        $filter = $this->request->getGet('type') ?? 'all';

        return view('panchang/vrat-list', [
            'title'  => 'Vrat Calendar',
            'vrats'  => $model->getAll($filter),
            'filter' => $filter,
        ]);
    }

    public function vratDetail(string $slug)
    {
        $model = new VratModel();
        $vrat  = $model->getBySlug($slug);
        if (!$vrat) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        return view('panchang/vrat-detail', [
            'title' => $vrat['vrat_name'],
            'vrat'  => $vrat,
        ]);
    }

    public function downloadCalendar()
    {
        // Placeholder — returns a PDF download
        // In production: use TCPDF or mpdf to generate
        $file = ROOTPATH . 'public/assets/downloads/panchang-2026.pdf';
        if (file_exists($file)) {
            return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'attachment; filename="Panchang-2026.pdf"')
                ->setBody(file_get_contents($file));
        }
        return redirect()->back()->with('error', 'Calendar not available yet');
    }

    public function todayJson()
    {
        $today = (new PanchangModel())->getToday();
        return $this->response->setJSON($today ?? []);
    }
}
