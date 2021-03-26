<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsScheduleds extends Model
{
 	protected $fillable = [
 		'user_id','scheduled_date','status', 'response',
 	];
}
