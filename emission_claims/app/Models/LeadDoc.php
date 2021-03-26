<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadDoc extends Model
{
	protected $table = 'lead_docs';
	protected $fillable = [
                            'user_id', 'tax_payer', 'user_insurance_number', 'spouses_insurance_number',
                            'user_identification_type', 'user_identification_image', 'spouses_identification_type', 'spouses_identification_image',
                        ];
}
