<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProduct extends Model
{
	protected $fillable = [
 		'user_id', 'product_id'
 	];
}
