<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
    public function children() //  $permission->children trở ra Object của permission_children
    {
        return $this->hasMany('App\Permission');
    }
}
