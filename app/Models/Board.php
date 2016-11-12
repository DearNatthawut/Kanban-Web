<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Board extends Model
{
    protected $table = 'boards';

    public function members()
    {
        return $this->belongsToMany(\App\Models\User::class,"membermanagement","Board_id","User_id");
           // ->wherePivot('Members_id','=',Auth::user()->id);
    }

    public function manager()
    {
        return $this->hasOne(\App\Models\User::class,"id","manager_id");
    }

    public function membersManager(){
        return $this->hasMany(\App\Models\Membermanagement::class,"Board_id");
    }

    public function cards(){
        return $this->hasMany(\App\Models\Card::class,"Board_id");
    }
}
