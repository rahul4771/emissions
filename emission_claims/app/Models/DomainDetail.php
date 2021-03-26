<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DomainDetail extends Model
{
    protected $fillable = [
                            'domain_name', 'type', 'status', 'last_active_date',
                        ];

    public function adv_info()
    {
        return $this->hasOne(App\Models\AdtopiaVisitor::class,'visitor_id','id');
    }
}
