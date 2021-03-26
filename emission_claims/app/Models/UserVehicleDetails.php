<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserVehicleDetails extends Model
{
    protected $table = 'user_vehicle_details';
    public $timestamps = true; 
    protected $fillable = [
    	'user_id', 'visitor_id','tr_smmt_range','make','engine_number','england_or_wales','model','fuel_type','registration_number','year_of_manufacture','tr_smmt_series','cherished_transfer_history','ma_vehicle_data','status', 'lead_id', 'cake_flag', 'buyer_api_flag', 'buyer_api_source'
    ];
}
