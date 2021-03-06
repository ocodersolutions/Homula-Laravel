<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
	public $timestamps = false;
	
    protected $fillable = ['address', 'alias', 'location', 'bedrooms', 'bathrooms', 'thumbnail', 'price', 'features', 'advanced', 'amenities', 'walkscore', 'map', 'slideshow', 'keyword', 'description'];
}
