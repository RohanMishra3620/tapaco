<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAllTables extends Migration
{
    public function up(): void
    {
        // users
        $this->forge->addField([
            'id'             => ['type'=>'INT','unsigned'=>true,'auto_increment'=>true],
            'phone'          => ['type'=>'VARCHAR','constraint'=>15,'unique'=>true],
            'name'           => ['type'=>'VARCHAR','constraint'=>100,'null'=>true],
            'otp'            => ['type'=>'VARCHAR','constraint'=>6,'null'=>true],
            'otp_expires_at' => ['type'=>'DATETIME','null'=>true],
            'verified'       => ['type'=>'TINYINT','default'=>0],
            'lang_pref'      => ['type'=>'ENUM','constraint'=>['en','hi'],'default'=>'en'],
            'subscribed'     => ['type'=>'TINYINT','default'=>0],
            'created_at'     => ['type'=>'DATETIME','null'=>true],
            'updated_at'     => ['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('users', true);

        // panchangs
        $this->forge->addField([
            'id'           => ['type'=>'INT','unsigned'=>true,'auto_increment'=>true],
            'date'         => ['type'=>'DATE','unique'=>true],
            'tithi'        => ['type'=>'VARCHAR','constraint'=>50],
            'paksha'       => ['type'=>'VARCHAR','constraint'=>30],
            'nakshatra'    => ['type'=>'VARCHAR','constraint'=>50],
            'sunrise_time' => ['type'=>'VARCHAR','constraint'=>10],
            'yoga'         => ['type'=>'VARCHAR','constraint'=>50,'null'=>true],
            'karana'       => ['type'=>'VARCHAR','constraint'=>50,'null'=>true],
            'created_at'   => ['type'=>'DATETIME','null'=>true],
            'updated_at'   => ['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('panchangs', true);

        // vrat_calendar
        $this->forge->addField([
            'id'          => ['type'=>'INT','unsigned'=>true,'auto_increment'=>true],
            'vrat_name'   => ['type'=>'VARCHAR','constraint'=>100],
            'slug'        => ['type'=>'VARCHAR','constraint'=>120,'unique'=>true],
            'date'        => ['type'=>'DATE'],
            'type'        => ['type'=>'ENUM','constraint'=>['ekadashi','pradosh','festival','other'],'default'=>'other'],
            'description' => ['type'=>'TEXT','null'=>true],
            'created_at'  => ['type'=>'DATETIME','null'=>true],
            'updated_at'  => ['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('vrat_calendar', true);

        // ritual_kits
        $this->forge->addField([
            'id'            => ['type'=>'INT','unsigned'=>true,'auto_increment'=>true],
            'name'          => ['type'=>'VARCHAR','constraint'=>150],
            'sku'           => ['type'=>'VARCHAR','constraint'=>50,'unique'=>true],
            'contents_json' => ['type'=>'JSON','null'=>true],
            'price'         => ['type'=>'DECIMAL','constraint'=>'10,2','default'=>0],
            'image_url'     => ['type'=>'VARCHAR','constraint'=>255,'null'=>true],
            'created_at'    => ['type'=>'DATETIME','null'=>true],
            'updated_at'    => ['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('ritual_kits', true);

        // ritual_guides
        $this->forge->addField([
            'id'               => ['type'=>'INT','unsigned'=>true,'auto_increment'=>true],
            'subcategory'      => ['type'=>'VARCHAR','constraint'=>60],
            'slug'             => ['type'=>'VARCHAR','constraint'=>160,'unique'=>true],
            'title'            => ['type'=>'VARCHAR','constraint'=>200],
            'tag'              => ['type'=>'VARCHAR','constraint'=>60,'null'=>true],
            'content_en'       => ['type'=>'LONGTEXT','null'=>true],
            'content_hi'       => ['type'=>'LONGTEXT','null'=>true],
            'audio_url'        => ['type'=>'VARCHAR','constraint'=>255,'null'=>true],
            'samagri_json'     => ['type'=>'JSON','null'=>true],
            'kit_id'           => ['type'=>'INT','unsigned'=>true,'null'=>true],
            'source'           => ['type'=>'VARCHAR','constraint'=>200,'null'=>true],
            'confidence_score' => ['type'=>'TINYINT','default'=>0],
            'created_at'       => ['type'=>'DATETIME','null'=>true],
            'updated_at'       => ['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('ritual_guides', true);

        // saved_rituals
        $this->forge->addField([
            'id'              => ['type'=>'INT','unsigned'=>true,'auto_increment'=>true],
            'user_id'         => ['type'=>'INT','unsigned'=>true],
            'ritual_guide_id' => ['type'=>'INT','unsigned'=>true],
            'created_at'      => ['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey(['user_id','ritual_guide_id']);
        $this->forge->createTable('saved_rituals', true);

        // pujas
        $this->forge->addField([
            'id'               => ['type'=>'INT','unsigned'=>true,'auto_increment'=>true],
            'name'             => ['type'=>'VARCHAR','constraint'=>150],
            'slug'             => ['type'=>'VARCHAR','constraint'=>160,'unique'=>true],
            'icon'             => ['type'=>'VARCHAR','constraint'=>10,'null'=>true],
            'description_en'   => ['type'=>'TEXT','null'=>true],
            'description_hi'   => ['type'=>'TEXT','null'=>true],
            'vidhi_preview'    => ['type'=>'TEXT','null'=>true],
            'samagri_included' => ['type'=>'TINYINT','default'=>1],
            'created_at'       => ['type'=>'DATETIME','null'=>true],
            'updated_at'       => ['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('pujas', true);

        // puja_variants
        $this->forge->addField([
            'id'               => ['type'=>'INT','unsigned'=>true,'auto_increment'=>true],
            'puja_id'          => ['type'=>'INT','unsigned'=>true],
            'name'             => ['type'=>'VARCHAR','constraint'=>100],
            'price'            => ['type'=>'DECIMAL','constraint'=>'10,2'],
            'duration_minutes' => ['type'=>'INT','default'=>60],
            'description'      => ['type'=>'TEXT','null'=>true],
            'created_at'       => ['type'=>'DATETIME','null'=>true],
            'updated_at'       => ['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('puja_variants', true);

        // pandits
        $this->forge->addField([
            'id'               => ['type'=>'INT','unsigned'=>true,'auto_increment'=>true],
            'name'             => ['type'=>'VARCHAR','constraint'=>100],
            'rating'           => ['type'=>'DECIMAL','constraint'=>'3,1','default'=>4.5],
            'languages_spoken' => ['type'=>'VARCHAR','constraint'=>200,'null'=>true],
            'photo_url'        => ['type'=>'VARCHAR','constraint'=>255,'null'=>true],
            'experience_years' => ['type'=>'TINYINT','default'=>0],
            'bio'              => ['type'=>'TEXT','null'=>true],
            'created_at'       => ['type'=>'DATETIME','null'=>true],
            'updated_at'       => ['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('pandits', true);

        // bookings
        $this->forge->addField([
            'id'        => ['type'=>'INT','unsigned'=>true,'auto_increment'=>true],
            'user_id'   => ['type'=>'INT','unsigned'=>true],
            'type'      => ['type'=>'ENUM','constraint'=>['puja','mandali','kit'],'default'=>'puja'],
            'ref_id'    => ['type'=>'INT','unsigned'=>true],
            'pandit_id' => ['type'=>'INT','unsigned'=>true,'null'=>true],
            'slot_date' => ['type'=>'DATE','null'=>true],
            'slot_time' => ['type'=>'TIME','null'=>true],
            'status'    => ['type'=>'ENUM','constraint'=>['pending','confirmed','cancelled'],'default'=>'pending'],
            'amount'    => ['type'=>'DECIMAL','constraint'=>'10,2','default'=>0],
            'created_at'=> ['type'=>'DATETIME','null'=>true],
            'updated_at'=> ['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('bookings', true);

        // mandali_types
        $this->forge->addField([
            'id'             => ['type'=>'INT','unsigned'=>true,'auto_increment'=>true],
            'name'           => ['type'=>'VARCHAR','constraint'=>120],
            'slug'           => ['type'=>'VARCHAR','constraint'=>130,'unique'=>true],
            'icon'           => ['type'=>'VARCHAR','constraint'=>10,'null'=>true],
            'description'    => ['type'=>'TEXT','null'=>true],
            'starting_price' => ['type'=>'DECIMAL','constraint'=>'10,2','null'=>true],
            'created_at'     => ['type'=>'DATETIME','null'=>true],
            'updated_at'     => ['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('mandali_types', true);

        // subscriptions
        $this->forge->addField([
            'id'              => ['type'=>'INT','unsigned'=>true,'auto_increment'=>true],
            'user_id'         => ['type'=>'INT','unsigned'=>true],
            'phone'           => ['type'=>'VARCHAR','constraint'=>15],
            'amount'          => ['type'=>'DECIMAL','constraint'=>'10,2','default'=>99],
            'starts_at'       => ['type'=>'DATE'],
            'expires_at'      => ['type'=>'DATE'],
            'status'          => ['type'=>'ENUM','constraint'=>['active','expired','cancelled'],'default'=>'active'],
            'whatsapp_number' => ['type'=>'VARCHAR','constraint'=>15,'null'=>true],
            'created_at'      => ['type'=>'DATETIME','null'=>true],
            'updated_at'      => ['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('subscriptions', true);
    }

    public function down(): void
    {
        $tables = [
            'subscriptions','mandali_types','bookings','pandits',
            'puja_variants','pujas','saved_rituals','ritual_guides',
            'ritual_kits','vrat_calendar','panchangs','users',
        ];
        foreach ($tables as $t) {
            $this->forge->dropTable($t, true);
        }
    }
}
