<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SignatureDetails extends Model
{
    protected $fillable 	=	['user_id','signature_id','previous_address_no','previous_postcode','previous_address_id','previous_address','previous_address_line1','previous_address_line2','previous_address_line3','previous_address_city','previous_address_province','previous_address_country','previous_address_company'];
}