<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComRegPage extends Model
{
    protected $fillable = ['name', 'banner_image', 'banner_heading', 'banner_description', 'benefits_description', 'features_description', 'overview_heading', 'overview_description', 'type_section_heading', 'business_legal_description', 'step_section_sub_heading', 'step_section_heading', 'step_section_description', 'why_section_heading', 'why_section_description', 'is_active', 'ref_id','license_ids','business_legal_ids','require_doc_ids', 'step_ids','why_ids','faq_ids'];
    
     protected $casts = [
        'license_ids' => 'array',
        'business_legal_ids' => 'array',
        'require_doc_ids' => 'array',
         'step_ids' => 'array',
          'why_ids' => 'array',
        'faq_ids' => 'array',
        
    ];
    
    public function comReg()
    {
        return $this->belongsTo(ComReg::class, 'ref_id');
    }

    public function subCategories()
    {
        return $this->hasMany(ComRegPage::class, 'ref_id');
    }

}