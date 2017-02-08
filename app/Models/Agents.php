<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agents extends Model
{
	public $timestamps = false;
	
    protected $fillable = ['name','email','alias','thumbnail','area_work','spoken_language'];
}
