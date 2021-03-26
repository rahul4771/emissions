<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserQuestionnaireMeta extends Model
{
	protected $table = 'user_questionnaire_meta';
   protected $fillable = [
       'user_id','bank_id','version','status' 
   ];
}
