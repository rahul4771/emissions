<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
 	protected $fillable = [
 		'tracker_master_id', 'site_flag_id', 'tracker_unique_id', 'ip_address', 'browser_type', 'country', 'device_type', 'user_agent', 'resolution', 'version', 'referer_site', 'existing_domain', 'full_reference_url', 'affiliate_id', 'campaign', 'split_idIndex', 'source', 'sub_tracker', 'tid', 'pid', 'adv_visitor_id', 'adv_page_name', 'adv_redirect_domain',
 	];

 	public function buyer()
 	{
 		return $this->belongsTo(BuyerDetail::class,'buyer_id','id');
 	}

 	public function tracker_master()
 	{
 		return $this->belongsTo(TrackerMaster::class,'tracker_master_id','id');
 	}

 	
 	public function adtopia_visitor()
    {
        return $this->hasOne(AdtopiaVisitor::class,'visitor_id','id');
    }

    public function thrive_visitor()
    {
        return $this->hasOne(ThriveVisitor::class,'visitor_id','id');
    }

    public function ho_cake_visitor()
    {
        return $this->hasOne(HoCakeVisitor::class,'visitor_id','id');
    }

 	public function Visitors_pixel_firing()
 	{
 		return $this->hasOne(VisitorsJourney::class,'visitor_id','id');
 	}
 	public function visitors_last_visit()
 	{
 		return $this->hasOne(VisitorsLastVisit::class,'visitor_id','id');
 	}
 	 	public function visitors_extra_detail()
 	{
 		return $this->hasOne(VisitorsExtraDetail::class,'visitor_id','id');
 	}

}
