<?php
/**
 * Created by PhpStorm.
 * User: DNOJ
 * Date: 3/23/2016
 * Time: 12:17 AM
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $table = 'checklists';
    protected $fillable = ['name','status'];

}
