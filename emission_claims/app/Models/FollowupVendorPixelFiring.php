<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FollowupVendorPixelFiring extends Model
{
	protected $table    = 'followup_vendor_pixel_firing';

    protected $fillable = ['followup_visit_id', 'visitor_id', 'user_id', 'vendor', 'page_type', 'pixel_type', 'pixel_log'];
}
