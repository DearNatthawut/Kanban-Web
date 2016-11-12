<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Membermanagement extends Model
{
    protected $table = 'membermanagement';

    public function member()
    {
        return $this->hasOne(\App\Models\User::class,"id","User_id");
    }

}
