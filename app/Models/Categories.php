<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
	public $timestamps = false;
    
    protected $fillable = ['name', 'alias', 'description', 'parent_id', 'published','meta_keywords','meta_description'];
}
