<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FollowupVisit extends Model
{
	protected $table    = 'followup_visit';

    protected $fillable = ['atp_sub2', 'user_id', 'visitor_id', 'tracker_unique_id', 'request', 'fireflag', 'adtopia_response', 'type','source'];
}
