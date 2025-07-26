<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicePage extends Model
{
    protected $fillable = ['name', 'description', 'banner_image', 'banner_heading', 'banner_description', 'extra_section', 'license_section_heading', 'business_legal_heading', 'business_legal_description', 'why_section_heading', 'why_section_description', 'benefit_heading', 'benefits_description', 'is_active', 'ref_id','license_ids','business_legal_ids','require_doc_ids', 'step_ids','why_ids','faq_ids','benefit_ids'];
    
     protected $casts = [
        'license_ids' => 'array',
        'business_legal_ids' => 'array',
        'require_doc_ids' => 'array',
         'step_ids' => 'array',
          'why_ids' => 'array',
        'faq_ids' => 'array',
        'benefit_ids' => 'array',
        
    ];
    
    public function service()
    {
        return $this->belongsTo(Service::class, 'ref_id');
    }

    public function subCategories()
    {
        return $this->hasMany(ServicePage::class, 'ref_id');
    }

}