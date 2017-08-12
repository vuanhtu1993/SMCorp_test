<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
    public function children()
    {
        return $this->hasMany('App\Permission');
    }
}
