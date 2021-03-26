<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyerApiResponseDetails extends Model
{
    protected $table = 'buyer_api_response_details';

    protected $fillable = [
                            'buyer_api_response_id', 'post_param', 'lead_value', 'status', 'created_at', 'updated_at'
                        ];
}
