<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFlowLog extends Model
{
    protected $table = 'user_flow_logs';
    protected $fillable = [
        'user_id', 'visitor_id', 'car_reg_no', 'vehicle_table_id', 'type'
    ];
}
