<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class LeftSidebarItem extends Model
{
    use HasRoles;

	protected $table = 'left_sidebars_items';
    protected $guard_name = 'web';
    
    //
    public function children()
    {
    	return $this->hasMany(LeftSidebarItem::class, 'parent_id');
    }

    public function parent()
    {
    	return $this->belongsTo(LeftSidebarItem::class, 'parent_id');
    }
}
