<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeftSidebar extends Model
{
    //

    public function items()
    {
    	return $this->hasMany(LeftSidebarItem::class, 'sidebar_id')->where('parent_id', null);
    }

    public function permissions()
    {
    	return $this->belongsToMany(Spatie\Permission\Models\Permission::class, 'left_sidebar_permissions', 'sidebar_id', 'permission_id');
    }
}
