<?php

namespace App\Controllers;

use App\Models\RitualGuideModel;
use App\Models\PujaModel;

class Search extends BaseController
{
    public function index()
    {
        $q = trim($this->request->getGet('q') ?? '');

        $results  = [];
        $empty    = false;
        $popular  = ['Satyanarayan Katha', 'Ekadashi Vrat', 'Rudrabhishek', 'Sundarkand', 'Navratri Puja'];
        $suggest  = '';

        if ($q !== '') {
            $ritualModel = new RitualGuideModel();
            $pujaModel   = new PujaModel();

            $guides = $ritualModel->search($q);
            $pujas  = $pujaModel->search($q);

            if (empty($guides) && empty($pujas)) {
                $empty   = true;
                $suggest = $this->suggest($q);
            } else {
                $results = [
                    'Ritual Guides' => $guides,
                    'Purohit & Puja' => $pujas,
                ];
            }
        }

        return view('search/index', [
            'title'   => 'Search',
            'q'       => $q,
            'results' => $results,
            'empty'   => $empty,
            'suggest' => $suggest,
            'popular' => $popular,
        ]);
    }

    private function suggest(string $q): string
    {
        $corrections = [
            'pooja'    => 'puja',
            'pandit'   => 'purohit',
            'bhajan'   => 'bhajan mandali',
            'ekadasi'  => 'ekadashi',
            'shivratri'=> 'Mahashivratri',
        ];
        foreach ($corrections as $typo => $fix) {
            if (stripos($q, $typo) !== false) return $fix;
        }
        return '';
    }
}
