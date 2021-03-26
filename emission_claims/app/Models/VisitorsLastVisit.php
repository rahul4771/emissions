<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorsLastVisit extends Model
{
    protected $table = 'visitors_last_visit';
    protected $fillable = [
    	'visitor_id', 'last_visit_page',
    ];

    public function visitor()
    {
       return $this->belongsTo(App\Models\Visitor::class,'visitor_id');
    }


}
