<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
	protected $fillable = [
 		'user_id','is_share'
 	];
}
