<?php

namespace App\Controllers;

use App\Models\PanchangModel;

class Home extends BaseController
{
    public function index()
    {
        $panchangModel = new PanchangModel();
        $today = $panchangModel->getToday();

        $data = [
            'title'    => 'Home',
            'panchang' => $today,
            'categories' => [
                ['slug'=>'ritual-guides',  'icon'=>'📖', 'label'=>'Ritual Guides',  'sub'=>'Step-by-step puja vidhi & mantra guides'],
                ['slug'=>'panchang',       'icon'=>'🗓', 'label'=>'Panchang',        'sub'=>'Daily tithi, nakshatra & vrat calendar'],
                ['slug'=>'purohit-puja',   'icon'=>'🛕', 'label'=>'Purohit & Puja',  'sub'=>'Book a verified pandit at home'],
                ['slug'=>'bhajan-mandali', 'icon'=>'🎶', 'label'=>'Bhajan Mandali',  'sub'=>'Sacred music for every auspicious occasion'],
            ],
            'carousel' => [
                ['title'=>"Today's Ritual",  'sub'=>'Shiva Abhishek',       'emoji'=>'🕉️', 'color'=>'from-saffron-dark to-saffron'],
                ['title'=>'Featured Guide',  'sub'=>'Satyanarayan Katha',   'emoji'=>'📿', 'color'=>'from-turmeric-dark to-turmeric'],
                ['title'=>'Upcoming Vrat',   'sub'=>'Ekadashi — in 3 days', 'emoji'=>'🌙',  'color'=>'from-deepmar to-ashgray'],
            ],
        ];

        return view('home/index', $data);
    }
}
