<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    protected $fillable = ['title', 'alias', 'thumbnail', 'content', 'excerpt', 'categories_id', 'published'];
}
