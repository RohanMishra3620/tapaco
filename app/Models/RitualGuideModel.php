<?php

namespace App\Models;

use CodeIgniter\Model;

class RitualGuideModel extends Model
{
    protected $table      = 'ritual_guides';
    protected $primaryKey = 'id';
    protected $allowedFields = ['subcategory','slug','title','tag','content_en','content_hi','audio_url','samagri_json','kit_id','source','confidence_score'];
    protected $useTimestamps  = true;

    public function getBySubcategory(string $sub): array
    {
        return $this->where('subcategory', $sub)->orderBy('id','ASC')->findAll();
    }

    public function getBySlug(string $slug): ?array
    {
        return $this->where('slug', $slug)->first();
    }

    public function search(string $q): array
    {
        return $this->like('title', $q)->orLike('content_en', $q)->findAll(10);
    }

    public function savedCount(int $userId): int
    {
        return $this->db->table('saved_rituals')->where('user_id', $userId)->countAllResults();
    }

    public function isSaved(int $userId, int $guideId): bool
    {
        return (bool) $this->db->table('saved_rituals')
            ->where(['user_id'=>$userId,'ritual_guide_id'=>$guideId])->countAllResults();
    }

    public function toggleSave(int $userId, int $guideId): bool
    {
        $db = $this->db->table('saved_rituals');
        if ($this->isSaved($userId, $guideId)) {
            $db->where(['user_id'=>$userId,'ritual_guide_id'=>$guideId])->delete();
            return false;
        }
        $db->insert(['user_id'=>$userId,'ritual_guide_id'=>$guideId]);
        return true;
    }
}
