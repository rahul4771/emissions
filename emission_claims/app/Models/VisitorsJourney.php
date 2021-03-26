<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorsJourney extends Model
{
    protected $table    =	'visitors_journey';
    protected $fillable = 	[
    	'visitor_id','user_id','page_type',
    ];

    public function visitor()
    {
       return $this->belongsTo(App\Models\Visitor::class,'visitor_id');
    }



}



