<?php
namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Model;

class GalleryCat extends Model {

    protected $fillable =  ['title'];
 
    public function items() {
        return $this->hasMany('App\Models\Gallery\GalleryItem', 'cat_id');
    }

}
