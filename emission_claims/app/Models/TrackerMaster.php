<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackerMaster extends Model
{
 	protected $fillable = [
 		'tracker_name', 'tracker_comment',
 	];
}
