<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteConfig extends Model
{
	public $timestamps      =   false;
    protected $table 		=	'site_config';
    protected $primaryKey 	=	'conf_id';
}
