<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlacklistedItem extends Model
{
    protected $fillable = [
                            'bi_value', 'bi_type',
                        ];
}
