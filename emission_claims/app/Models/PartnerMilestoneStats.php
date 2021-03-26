<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerMilestoneStats extends Model
{
	protected $table = 'partner_milestone_stats';
    protected $fillable = [
        'user_id','partner_signature','partner_questions','spouses_insurance_number','partner_identification_type','partner_identification_image','source','is_share'
    ];
}
