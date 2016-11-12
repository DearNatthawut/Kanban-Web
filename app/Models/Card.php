<?php
/**
 * Created by PhpStorm.
 * User: DNOJ
 * Date: 3/2/2016
 * Time: 11:05 PM
 * Card Model
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table = 'cards';
    protected $fillable = ['name','detail','MemberManagement_id','priority_id','color'];

    public function checklists(){
        return $this->hasMany(\App\Models\Checklist::class,"Card_id");
    }

  
    public function comments(){
        return $this->hasMany(\App\Models\Comment::class,"Card_id");
    }
    

    public function memberCard()
    {
       return $this->belongsTo(\App\Models\Membermanagement::class,"MemberManagement_id","id" );

    }



    public function preCard()
    {
        return $this->belongsTo(\App\Models\Card::class,"child_id","id" );

    }
    



}
