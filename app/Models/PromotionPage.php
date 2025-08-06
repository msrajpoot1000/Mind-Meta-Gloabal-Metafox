<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromotionPage extends Model
{
    protected $fillable = ['name', 'description', 'banner_image', 'banner_heading', 'banner_description', 'is_active', 'ref_id'];
    
    public function promotion()
    {
        return $this->belongsTo(Promotion::class, 'ref_id');
    }


    public function promotionOffers()
{
    return $this->hasMany(PromotionOffer::class, 'ref_id');
}



}