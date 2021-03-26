<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SplitSetting extends Model
{
    //protected $table = 'split_settings';

    public function getDescriptionAttribute($value)
    {
        return html_entity_decode(strip_tags($value));
    }
}
