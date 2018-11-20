<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    public function children()
    {
    	return $this->hasMany(LeftSidebarItem::class, 'sidebar_id');
    }
}
