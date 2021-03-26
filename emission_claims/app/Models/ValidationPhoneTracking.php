<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ValidationPhoneTracking extends Model
{
    //
    protected $table = 'validation_phone_tracking';
    
    protected $fillable = [
 		'validation_type',
 	];
}
