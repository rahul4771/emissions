<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class SiteFlagMaster extends Model
{
 	protected $fillable = [
    	'site_flag_name', 'site_flag_comment',
 	];
}
