<?php
/**
 * Created by PhpStorm.
 * User: DNOJ
 * Date: 4/24/2016
 * Time: 11:11 PM
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['detail'];

    public function memberComment()
    {
        return $this->hasOne(\App\Models\User::class,"id","User_id");
    }

}