<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncompleteLead extends Model
{
 	protected $fillable = [
 		'user_bank_id', 'status',
 	];

}
