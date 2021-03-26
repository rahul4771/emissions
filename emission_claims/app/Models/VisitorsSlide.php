<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorsSlide extends Model
{
    protected $fillable = [
		'name', 'split_id', 'visitor_id','user_id'
	];
}
