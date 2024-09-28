<?php

namespace App\Traits;

use App\Models\Admin\User\Role;
use App\Models\Admin\User\Permission;

trait ACL
{
    protected $userPermissions = [];
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasPermission($permission): bool
    {
        $accessPermission = $this->setPermissions();
        
        if (in_array($permission, $accessPermission)) {
            return true;
        }

        return false;
    }

    public function hasRoles(...$roles): bool
    {
        foreach ($roles as $role) {
            if ($this->roles->contains("name", $role)) {
                return true;
            }
        }

        return false;
    }

    protected function setPermissions()
    {

        foreach ($this->roles as $role) {
            foreach ($role->permissions as $permission) {
                array_push($this->userPermissions, $permission->name);
            }
        }

        foreach ($this->permissions as $permission) {
            array_push($this->userPermissions, $permission->name);
        }

        return $this->userPermissions;
    }
}