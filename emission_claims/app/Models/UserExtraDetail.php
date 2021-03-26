<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserExtraDetail extends Model
{
	protected $table = 'user_extra_details';
 	protected $fillable = [
 		'user_id', 'postcode', 'street', 'town', 'county', 'address', 'country', 'housenumber', 'housename', 'address3', 'udprn', 'pz_mailsort', 'deliverypointsuffix', 'addressid', 'previous_name', 'unique_key', 'is_pixel_fire', 'is_fb_pixel_fired', 'pixel_log', 'pixel_type','qualify_status'
 	];
}