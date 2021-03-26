<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsScheduled extends Model
{
    protected $fillable 		=	['user_id','sms_batch_id','status','scheduled_date'];
}