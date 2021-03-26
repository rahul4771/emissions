<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdtopiaVisitor extends Model {
    protected $fillable = [
                            'visitor_id', 'atp_source', 'atp_vendor', 'atp_sub1', 'atp_sub2', 'atp_sub3', 'atp_sub4', 'atp_sub5',
                        ];

    public $timestamps  = false;

    public function visitor()
    {
        return $this->belongsTo(App\Models\Visitor::class,'visitor_id');
    }
}
