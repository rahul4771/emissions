<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiHistory extends Model
{
    protected $table = 'api_histories';
    protected $fillable = ['user_id','url','request','response'];
}
