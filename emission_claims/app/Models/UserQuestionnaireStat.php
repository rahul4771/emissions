<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserQuestionnaireStat extends Model
{
    protected $fillable = [
        'user_id','bank_id','questionnaire_id','source' 
    ];
}
