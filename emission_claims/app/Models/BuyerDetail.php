<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyerDetail extends Model
{
    protected $fillable = [
                            'buyer_name', 'data_key', 'status',
                        ];
}
