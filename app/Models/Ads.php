<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ads extends Model
{
    public $timestamps = false;
	
    protected $fillable = ['name','thumbnail','content'];
}
