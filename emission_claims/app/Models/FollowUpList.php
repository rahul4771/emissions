<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FollowUpList extends Model
{
    protected $table    = 'followup_list';

    protected $fillable = ['bank_details', 'questions', 'sms_strategy_date'];
}
