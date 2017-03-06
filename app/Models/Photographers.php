<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photographers extends Model
{
	var $table ="photographers";
    public $timestamps = false;
	
    protected $fillable = ['name','alias','company','phone','email','web','city'];
}
