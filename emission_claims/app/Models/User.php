<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'email', 'password','token'
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function visitor()
    {
        return $this->belongsTo(Visitor::class,'visitor_id','id');
    }
    public function details()
    {
        return $this->hasOne(UserExtraDetail::class,'user_id','id');
    }
    public function partnerDetails()
    {
        return $this->hasOne(UserSpousesDetails::class,'user_id','id');
    }
    public function leadDocsDetails()
    {
        return $this->hasOne(LeadDoc::class,'user_id','id');
    }
    public function userSignature()
    {
        return $this->hasOne(Signature::class,'user_id','id');
    }
    public function userQuestionAnswers()
    {
      return $this->hasMany(UserQuestionnaireAnswers::class,'user_id','id');  
    }
}
