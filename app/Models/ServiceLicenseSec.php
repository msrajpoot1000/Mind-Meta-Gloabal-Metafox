<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceLicenseSec extends Model {
    protected $fillable = ['license_image', 'license_name', 'license_description', 'is_active'];
    //
}
