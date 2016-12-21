<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    var $table = 'menus';

    public $timestamps = false;
    
    protected $fillable = ['name', 'alias', 'icon', 'parent_id', 'link', 'target', 'publisher',];

    public function setUpdatedAtAttribute($value)
	{
	    // to Disable updated_at
	}
}
