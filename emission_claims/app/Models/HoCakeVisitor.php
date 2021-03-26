<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HoCakeVisitor extends Model
{
 	protected $fillable = [
 		'visitor_id', 'aff_id', 'aff_sub', 'aff_sub2', 'aff_sub3', 'aff_sub4', 'aff_sub5', 'offer_id', 'aff_unique1', 'aff_unique2', 'aff_unique3', 'subid1', 'subid2', 'subid3',
 	];
 	public $timestamps = false;

 	public function visitor()
 	{
 		return $this->belongsTo(App\Models\Visitor::class,'visitor_id');
 	}
}
