<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ValidationEmailTracking extends Model
{
    //
    protected $table = 'validation_email_tracking';
    
    protected $fillable = [
 		'visitor_id','validated_email','result','result_details','validated_date', 
 	];
}
