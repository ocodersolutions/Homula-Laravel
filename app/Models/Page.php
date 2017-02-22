<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
	var $table = 'page';

    public $timestamps = false;
	
    protected $fillable = ['title','alias','thumbnail','content','page_parent','template'];
}
