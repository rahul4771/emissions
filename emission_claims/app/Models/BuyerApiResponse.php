<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyerApiResponse extends Model
{
    protected $table = 'buyer_api_responses';

    protected $fillable = [
                            'buyer_id', 'user_id', 'bank_id', 'signature_id', 'result', 'lead_id', 'created_at', 'updated_at'
                        ];
}
