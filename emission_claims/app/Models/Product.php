<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
 		'product_name', 'product_slug', 'split_name', 'status'
 	];
}
