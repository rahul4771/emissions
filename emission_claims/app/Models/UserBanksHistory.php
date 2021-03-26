<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBanksHistory extends Model
{
	protected $fillable = [
		'user_id', 'old_bank_id', 'new_bank_id','updated_at'
	];

}
