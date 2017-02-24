<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    var $table = 'meta_list';

    public $timestamps = false;
	
    protected $fillable = ['name','alias','keyword','description'];
}
