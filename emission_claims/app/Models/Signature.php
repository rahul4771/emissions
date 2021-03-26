<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
 	
    protected $table = 'signatures';
 	protected $fillable = [
 		'user_id', 'bank_id', 'type', 'signature_image', 'pdf_file', 's3_file_path', 'status','updated_at'
 	];
}
