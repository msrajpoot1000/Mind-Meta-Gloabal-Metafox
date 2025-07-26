<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinServicePage extends Model
{
    
    protected $fillable = ['name', 'banner_image', 'banner_heading', 'banner_description', 'page_sec_heading', 'page_sec_description', 'extra_section', 'benifits_sec_heading', 'benefits_description', 'why_section_heading', 'why_section_description', 'is_active','benefit_ids','why_ids','faq_ids', 'ref_id'];
    
    protected $casts = [
        'benefit_ids' => 'array',
          'why_ids' => 'array',
        'faq_ids' => 'array',
        
    ];
    
    public function finService()
    {
        return $this->belongsTo(FinService::class, 'ref_id');
    }

    public function subCategories()
    {
        return $this->hasMany(FinServicePage::class, 'ref_id');
    }


}