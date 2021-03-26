<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBank extends Model
{
	protected $fillable = [
		'user_id', 'bank_id', 'bank_account_id','bank_sort_code','bank_account_number'
	];

	public function bank()
	{
		return $this->belongsTo('App\Models\Bank', 'bank_id', 'id');
	}
}
