<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMilestoneStats extends Model
{
	protected $table = 'user_milestone_stats';
    protected $fillable = [
        'user_id','user_signature','partner_signature','questions','partner_details','user_insurance_number','spouses_insurance_number','identification_type','identification_image','completed','sale','source','partner_questions'
    ];
}
