<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JointAccountDetails extends Model
{
 	protected $fillable = [
 		'user_id', 'user_bank_id', 'first_name','last_name','dob', 'ja_signature_type', 'null_signature_reason', 'ja_signature_image'
 	];
}
