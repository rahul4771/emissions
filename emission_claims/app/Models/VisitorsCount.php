<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorsCount extends Model
{
    protected $table = 'visitors_count';
    protected $fillable = [
    	'visitor_id', 'count', 'split_id',
    ];

     public function split_info()
    {
       return $this->belongsTo(App\Models\SplitInfo::class,'split_id');
    }
    public function visitor()
    {
       return $this->belongsTo(App\Models\Visitor::class,'visitor_id');
    }
  
}
