<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserQuestionnaireAnswers extends Model
{
 	protected $fillable = [
 		'user_id', 'bank_id', 'questionnaire_id', 'questionnaire_option_id', 'input_answer', 'status',
 	];
}
