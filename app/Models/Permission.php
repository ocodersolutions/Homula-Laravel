<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable =  ['name', 'display_name', 'description', 'created_at', 'updated_at'];

    var $table = 'permissions';
    /**
     * The videos that belong to the playlist.
     */
    public function Role(){
    	return $this->belongsToMany('App\Models\Role', 'permission_role');
    }
}
