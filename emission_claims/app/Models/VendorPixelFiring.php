<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorPixelFiring extends Model
{
	protected $table = 'vendor_pixel_firing';
	protected $fillable = [
		'visitor_id', 'user_id', 'vendor', 'page_type', 'pixel_type', 'pixel_log', 'pixel_result'
	];
}
