<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
 	protected $fillable = [
 		'bank_id', 'title', 'is_required', 'type', 'form_type', 'status',
 	];
 	public function options()
 	{
 		return $this->hasMany('App\Models\QuestionnaireOptions','questionnaire_id','id');
 	}
}
