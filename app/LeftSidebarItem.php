<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeftSidebarItem extends Model
{
	protected $table = 'left_sidebars_items';
	
    //
    public function children()
    {
    	return $this->hasMany(LeftSidebarItem::class, 'parent_id');
    }

    public function parent()
    {
    	return $this->belongsTo(LeftSidebarItem::class, 'parent_id');
    }

    public function permissions()
    {
    	return $this->belongsToMany(Spatie\Permission\Models\Permission::class, 'left_sidebar_items_permissions', 'sidebar_item_id', 'permission_id');
    }
}
