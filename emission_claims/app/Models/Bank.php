<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
   protected $fillable = [
                            'bank_code', 'bank_name', 'rank', 'sign_type', 'status',
                       ];
}
