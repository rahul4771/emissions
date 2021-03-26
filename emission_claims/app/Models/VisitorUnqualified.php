<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorUnqualified extends Model
{
      protected $fillable = [
		'visitor_id', 'question_id', 'answer_id','input_answer'
	];
}
