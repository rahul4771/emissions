<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PdfTrigger extends Model
{
    protected $fillable 	=	[
    	'user_id','sale_status','qualify_status','trigger_type','status','post_crm'
    ];
}
