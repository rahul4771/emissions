<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThriveVisitor extends Model
{
 	protected $fillable = [
 		'visitor_id', 'thr_source', 'thr_sub1', 'thr_sub2', 'thr_sub3', 'thr_sub4', 'thr_sub5', 'thr_sub6', 'thr_sub7', 'thr_sub8', 'thr_sub9', 'thr_sub10',
 	];
 	public $timestamps = false;

 	public function visitor()
 	{
 		return $this->belongsTo(Visitor::class,'visitor_id');
 	}
}
