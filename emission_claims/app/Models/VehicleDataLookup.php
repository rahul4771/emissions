<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleDataLookup extends Model
{
    protected $table = 'vehicle_data_lookup';
    public $timestamps = true;
    protected $fillable = [
    	'visitor_id', 'tr_smmt_range','make','engine_number','england_or_wales','model','fuel_type','registration_number','year_of_manufacture','tr_smmt_series','cherished_transfer_history','ma_vehicle_data','status',
    ];
}
