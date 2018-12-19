<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionGroup extends Model
{
    //
    public function permissions()
    {
        return $this->hasMany(Permission::class, 'group');
    }
}
