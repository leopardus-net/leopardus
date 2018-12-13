<?php

namespace App;

use Spatie\Permission\Models\Role as Model;

class Role extends Model
{
    protected $fillable = ['name', 'guard_name'];

    public function __construct(array $attributes = [])
    {
        $attributes['guard_name'] = $attributes['guard_name'] ?? config('auth.defaults.guard');

        parent::__construct($attributes);

        $this->setTable(config('permission.table_names.roles'));
    }
}
