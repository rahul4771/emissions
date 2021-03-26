<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FollowupHistories extends Model
{
    protected $fillable = [
        'user_id','type','type_id','value','source','post_crm' 
    ];

    public function question()
    {
    	return $this->hasOne('App\Models\Questionnaire','id','type_id');
    }

    public function options()
 	{
 		return $this->hasMany('App\Models\QuestionnaireOptions','id','value');
 	}
}
