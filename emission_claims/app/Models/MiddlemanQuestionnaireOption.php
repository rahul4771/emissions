<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MiddlemanQuestionnaireOption extends Model
{
	protected $table    = 'middleman_questionnaire_options';

    protected $fillable = ['questionnaire_id', 'option_label', 'option_value', 'option_target', 'live_id', 'crm_id', 'status'];
}
