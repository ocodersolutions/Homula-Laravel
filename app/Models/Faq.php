<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    var $table = 'faq';

    public $timestamps = false;
	
    protected $fillable = ['question','answer'];
}
