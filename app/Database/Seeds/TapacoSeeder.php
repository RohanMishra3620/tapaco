<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TapacoSeeder extends Seeder
{
    public function run(): void
    {
        // Panchang - next 7 days
        $tithis    = ['Pratipada','Dwitiya','Tritiya','Chaturthi','Panchami','Shashthi','Saptami','Ashtami','Navami','Dashami','Ekadashi','Dwadashi','Trayodashi','Chaturdashi','Purnima'];
        $nakshatras= ['Ashwini','Bharani','Krittika','Rohini','Mrigashirsha','Ardra','Punarvasu','Pushya','Ashlesha','Magha'];
        $pakshas   = ['Shukla','Krishna'];
        for ($i = 0; $i < 7; $i++) {
            $this->db->table('panchangs')->ignore(true)->insert([
                'date'         => date('Y-m-d', strtotime("+{$i} days")),
                'tithi'        => $tithis[($i + 10) % 15],
                'paksha'       => $pakshas[$i % 2],
                'nakshatra'    => $nakshatras[$i % 10],
                'sunrise_time' => '06:0' . (2 + $i % 5) . ' AM',
                'yoga'         => 'Siddha',
                'karana'       => 'Bava',
            ]);
        }

        // Vrat Calendar
        $vrats = [
            ['Ekadashi','ekadashi-june',date('Y-m-d',strtotime('+3 days')),'ekadashi','Observe fast, chant Vishnu Sahasranama'],
            ['Pradosh Vrat','pradosh-june',date('Y-m-d',strtotime('+5 days')),'pradosh','Lord Shiva fasting day'],
            ['Purnima','purnima-june',date('Y-m-d',strtotime('+8 days')),'festival','Full moon — auspicious for Satyanarayan Katha'],
            ['Amavasya','amavasya-july',date('Y-m-d',strtotime('+22 days')),'other','New moon — ideal for ancestor rituals'],
            ['Guru Purnima','guru-purnima',date('Y-m-d',strtotime('+18 days')),'festival','Worship your Guru and seek blessings'],
        ];
        foreach ($vrats as $v) {
            $this->db->table('vrat_calendar')->ignore(true)->insert([
                'vrat_name'=>$v[0],'slug'=>$v[1],'date'=>$v[2],'type'=>$v[3],'description'=>$v[4],
                'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'),
            ]);
        }

        // Ritual Kits
        $this->db->table('ritual_kits')->ignore(true)->insert([
            'name'=>'Rudrabhishek Kit','sku'=>'KIT-001',
            'contents_json'=>json_encode(['Bilva leaves','Panchamrit','Dhoop sticks','Gangajal','Kumkum','Chandan']),
            'price'=>599,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'),
        ]);
        $this->db->table('ritual_kits')->ignore(true)->insert([
            'name'=>'Satyanarayan Katha Kit','sku'=>'KIT-002',
            'contents_json'=>json_encode(['Panchamrit','Tulsi','Panchmeva','Dhoop','Deepam oil','Yellow flowers']),
            'price'=>799,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'),
        ]);

        // Ritual Guides
        $guides = [
            ['festive-pujans','rudrabhishek-guide','Rudrabhishek Puja','Dharma',1,'<p>Rudrabhishek is the sacred bathing of Shiva Linga with Panchamrit — milk, curd, honey, ghee and sugar — while chanting the powerful Shri Rudram. This ritual cleanses negative karma and bestows divine blessings.</p><p>Begin by purifying yourself and the worship space. Place a Shiva Linga or a photograph on a clean altar facing east.</p><h3>Step-by-Step Vidhi</h3><ol><li>Perform Achamana — purify with water thrice</li><li>Light the lamp and incense</li><li>Pour Panchamrit on the Shiva Linga while chanting <em>Om Namah Shivaya</em></li><li>Offer Bilva leaves in sets of three</li><li>Light the Dhoop and perform Aarti</li></ol>','<p>रुद्राभिषेक भगवान शिव की पूजा का सबसे शक्तिशाली रूप है।</p>'],
            ['festive-pujans','satyanarayan-katha-guide','Satyanarayan Katha','Pratha',1,'<p>The Satyanarayan Vrat Katha is performed on Purnima or any auspicious occasion to seek the blessings of Lord Vishnu. It brings peace, prosperity and fulfillment of desires.</p><h3>Step-by-Step Vidhi</h3><ol><li>Set up the altar with Lord Vishnu\'s image</li><li>Prepare Panchamrit and Prasad (Sheera)</li><li>Read all five chapters of the Katha</li><li>Distribute Prasad to all devotees</li></ol>','<p>सत्यनारायण कथा भगवान विष्णु की कृपा पाने का सरल मार्ग है।</p>'],
            ['all-year-pujans','ganesh-puja-guide','Ganesh Puja','Dharma',1,'<p>Begin every auspicious work with Ganesh Puja to remove obstacles and invoke divine wisdom. Lord Ganesha is the remover of all obstacles and the lord of beginnings.</p><h3>Step-by-Step Vidhi</h3><ol><li>Place Ganesha idol facing east</li><li>Offer Modak, Durva grass and red flowers</li><li>Chant Ganesh Atharvashirsha</li><li>Perform Aarti</li></ol>','<p>हर शुभ कार्य से पहले गणेश पूजा करें।</p>'],
            ['navagraha-pujans','surya-puja-guide','Surya Puja','Pratha',1,'<p>Sunday is the ideal day for Surya Puja. Offering water to the sun god at sunrise removes health issues and brings vitality and success.</p><h3>Step-by-Step Vidhi</h3><ol><li>Wake up before sunrise</li><li>Offer water (Arghya) while facing east</li><li>Chant Aditya Hridayam or Gayatri Mantra</li><li>Wear red on Sundays</li></ol>','<p>सूर्य पूजा से आरोग्य और यश की प्राप्ति होती है।</p>'],
        ];
        foreach ($guides as $g) {
            $this->db->table('ritual_guides')->ignore(true)->insert([
                'subcategory'=>$g[0],'slug'=>$g[1],'title'=>$g[2],'tag'=>$g[3],'kit_id'=>$g[4],
                'content_en'=>$g[5],'content_hi'=>$g[6],
                'samagri_json'=>json_encode(['Flowers','Dhoop','Deepam','Kumkum','Chandan']),
                'source'=>'Shastra','confidence_score'=>92,
                'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'),
            ]);
        }

        // Pujas
        $pujas = [
            ['Rudrabhishek','rudrabhishek','🕉️','Powerful Shiva puja with Panchamrit abhishek and Bilva archana.'],
            ['Satyanarayan Katha','satyanarayan-katha','📿','Complete Katha with 5 chapters — ideal for new beginnings.'],
            ['Musical Mandali','musical-mandali','🎶','Devotional music with harmonium and tabla.'],
            ['Navratri Ghatsthapna','navratri-ghatsthapna','🪔','9-day Navratri Kalash sthapna with daily rituals.'],
        ];
        foreach ($pujas as $p) {
            $this->db->table('pujas')->ignore(true)->insert([
                'name'=>$p[0],'slug'=>$p[1],'icon'=>$p[2],'description_en'=>$p[3],
                'vidhi_preview'=>'Achamana → Sankalpa → Puja → Aarti → Prasad',
                'samagri_included'=>1,
                'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'),
            ]);
        }

        // Puja Variants
        $variantData = [
            [1,'Sankshipt (Short)',7100,90,'45-min puja, 1 pandit'],
            [1,'Vistrit (Extended)',14000,180,'Full 3-hr puja with havan'],
            [2,'Standard',5100,120,'Complete Katha with prasad'],
            [2,'Premium',9100,180,'Katha + havan + full decoration'],
            [3,'Standard',8000,150,'3 musicians, 90-min session'],
            [4,'9-day Puja',21000,0,'Full Navratri package'],
        ];
        foreach ($variantData as $v) {
            $this->db->table('puja_variants')->ignore(true)->insert([
                'puja_id'=>$v[0],'name'=>$v[1],'price'=>$v[2],'duration_minutes'=>$v[3],'description'=>$v[4],
                'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'),
            ]);
        }

        // Pandits
        $pandits = [
            ['Pandit Rameshwar Shastri',4.9,'Hindi, English',12,'Expert in Vedic rituals'],
            ['Pandit Suresh Kumar',4.7,'Hindi, Punjabi',8,'Specialises in Shiva pujas'],
            ['Pandit Avinash Tiwari',4.8,'Hindi',15,'North India tradition'],
        ];
        foreach ($pandits as $p) {
            $this->db->table('pandits')->ignore(true)->insert([
                'name'=>$p[0],'rating'=>$p[1],'languages_spoken'=>$p[2],
                'experience_years'=>$p[3],'bio'=>$p[4],
                'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'),
            ]);
        }

        // Bhajan Mandali types
        $mandalis = [
            ['Sundarkand','sundarkand','📖','Recitation of Sundarkand from Ramcharitmanas',5000],
            ['Mata Ki Chowki','mata-ki-chowki','🪔','Devotional singing for Mata Rani',6000],
            ['Shyam Darbaar','shyam-darbaar','💙','Khatu Shyam bhajan night',5500],
            ['Ram Darbaar','ram-darbaar','🔱','Ram bhajans and Hanuman Chalisa',4500],
            ['Shiva Stotra Satsang','shiva-stotra-satsang','🕉️','Shiva stotras and devotional songs',4000],
            ['Generic Bhajan Mix','generic-bhajan-mix','🎵','Mix of devotional songs of your choice',3500],
        ];
        foreach ($mandalis as $m) {
            $this->db->table('mandali_types')->ignore(true)->insert([
                'name'=>$m[0],'slug'=>$m[1],'icon'=>$m[2],'description'=>$m[3],'starting_price'=>$m[4],
                'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'),
            ]);
        }
    }
}
