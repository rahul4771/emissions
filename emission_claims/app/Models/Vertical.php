<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vertical extends Model
{
	protected $fillable = [
		'vertical_name', 'vertical_comment',
	];
}
