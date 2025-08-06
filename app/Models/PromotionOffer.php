<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromotionOffer extends Model
{
    protected $fillable = [
        'offer_image', 'offer_title', 'offer_price', 'offer_description', 'is_active', 'ref_id',
    ];
    public function promotion()
    {
        return $this->belongsTo(Promotion::class, 'ref_id');
    }
    public function promotionPage()
    {
        return $this->belongsTo(PromotionPage::class, 'ref_id');
    }
}