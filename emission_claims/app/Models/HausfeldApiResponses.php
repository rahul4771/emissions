<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HausfeldApiResponses extends Model
{
    protected $fillable = [
        'user_id', 'api', 'url', 'params', 'api_response', 'remark', 'status', 'request_source'
    ];
}
