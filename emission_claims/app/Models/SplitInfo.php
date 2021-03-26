<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class SplitInfo extends Model
{
    protected $table = 'split_info';
    protected $fillable = [
    	'domain_id', 'buyer_id', 'split_name', 'split_path', 'status', 'last_active_date',
    ];


    public function visitors_extra_detail()
 	{
 		return $this->hasOne(App\Models\VisitorsExtraDetail::class,'split_id','id');
 	}



}
