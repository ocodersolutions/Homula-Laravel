<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model {

//    protected $fillable = ['type', 'title','image','published','ordering'];

    public function cat() {
        return $this->belongsTo('App\Models\Gallery\GalleryCat', 'cat_id');
    }

}
