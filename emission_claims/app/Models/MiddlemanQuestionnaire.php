<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MiddlemanQuestionnaire extends Model
{
	protected $table    = 'middleman_questionnaires';

    protected $fillable = ['question_title', 'form_type', 'parent_id', 'live_id', 'crm_id', 'status'];
}
