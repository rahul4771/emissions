<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserQuestionnaireAnswersHistories extends Model
{
	protected $fillable = [
 		'user_id', 'bank_id', 'type', 'raw_data','source'
	 ];

    //
}
