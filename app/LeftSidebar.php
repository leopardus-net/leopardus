<?php

namespace App;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class LeftSidebar extends Model
{
    use HasRoles;

    protected $guard_name = 'web';

    public function getItemsByPermissions($permissions)
    {
        return LeftSidebarItem::where('sidebar_id', $this->id)
                    ->where('parent_id', null)
                    ->permission($permissions)
                    ->get();
    }
}
