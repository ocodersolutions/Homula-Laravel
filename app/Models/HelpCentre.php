<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HelpCentre extends Model
{
    var $table = 'help_centre';

    public $timestamps = false;
	
    protected $fillable = ['question','alias','answer','categories_id'];
}
