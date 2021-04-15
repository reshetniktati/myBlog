<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\Permission;

/**
 * Trait HasRoleAndPermissions
 *
 * @package App\Traits
 */
trait HasRoleAndPermissions {

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class,'users_roles');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'users_permissions');
    }

    /**
     * @param mixed ...$roles
     *
     * @return bool
     */
    public function hasRole(...$roles)
    {
        foreach($roles as $role) {
            return $this->roles->contains('name', $role);
        }
    }

    /**
     * @param $permission_id
     *
     * @return bool
     */
    public function hasPermission($permission_id) :bool
    {
        $this->permissions->where('id', $permission_id)->count();
    }

    /**
     * @param $permission
     *
     * @return bool
     */
    public function hasPermissionTo($permission)
    {
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission->id);
    }

    /**
     * @param $permission
     *
     * @return bool
     */
    public function hasPermissionThroughRole($permission)
    {
        foreach ($permission->roles as $role) {
            if ($this->roles->contains($role)) {
                return true;
            }
            return false;
        }
    }

    /**
     * @param $permissions
     *
     * @return mixed
     */
    public function getAllPermissions($permissions)
    {
        return Permission::whereIn('id', $permissions)->get();
    }

    /**
     * @param mixed ...$permissions
     *
     * @return $this
     */
    public function givePermissionsTo(...$permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        if($permissions === null) {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }

    public function deletePermissions(... $permissions )
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }

    public function refreshPermissions(... $permissions )
    {
        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions);
    }


}
