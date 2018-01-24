<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Writing extends Model
{
    protected $table =  'writing';
    protected $primaryKey=  'id';
    public $timestamps=false;
    protected $guarded = [];
}
