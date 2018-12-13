<?php

namespace App;

use Spatie\Permission\Models\Permission as Model;

class Permission extends Model
{
    //
    protected $fillable = ['name', 'group', 'guard_name'];

    public function __construct(array $attributes = [])
    {
        $attributes['guard_name'] = $attributes['guard_name'] ?? config('auth.defaults.guard');

        parent::__construct($attributes);
    }
}
