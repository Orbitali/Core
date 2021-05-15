<?php
namespace Orbitali\Foundations\Datasources;

use Orbitali\Http\Models\Role;

class Roles
{
    public function source()
    {
        return Role::get()->mapWithKeys(function ($role) {
            return [$role->id => $role->title ?? $role->id];
        });
    }
}
