<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionnaireOptions extends Model
{
 	protected $fillable = [
 		'questionnaire_id', 'value', 'status',
 	];
}
