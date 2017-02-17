<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
	public $timestamps = false;
	
    protected $fillable = ['address', 'thumbnail', 'price', 'city'];
}
