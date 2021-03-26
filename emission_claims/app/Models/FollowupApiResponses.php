<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FollowupApiResponses extends Model
{
    //
    protected $table = 'followup_api_responses';
    protected $fillable = [
        'user_id','contact','type','message','subject','user_type','request','response' 
    ];
}
