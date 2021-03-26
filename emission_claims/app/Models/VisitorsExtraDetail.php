<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorsExtraDetail extends Model
{
	protected $fillable = [
		'visitor_id', 'split_id', 'ext_var1', 'ext_var2', 'ext_var3', 'ext_var4', 'ext_var5',
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
