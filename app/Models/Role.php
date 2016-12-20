<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	var $table = 'Roles';
	
	protected $fillable = ['name', 'display_name', 'description',];

    public function Permissions(){
    	return $this->belongsToMany('App\Models\Permission', 'permission_role');
    }
}
