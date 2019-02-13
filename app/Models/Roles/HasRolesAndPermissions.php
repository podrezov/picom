<?php namespace App\Models\Roles;

use App\Models\Roles\Role;
use Illuminate\Support\Collection;

trait HasRolesAndPermissions
{
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    /**
     * @param string|array|Collection $roles
     *
     * @return bool
     */
    public function hasRole($roles): bool
    {
        if (is_string($roles)) {
            return $this->roles->contains('name', $roles);
        }

        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }

            return false;
        }

        return $roles->intersect($this->roles)->isNotEmpty();
    }

    /**
     * @param $roles
     *
     * @return $this
     */
    public function addRole($roles)
    {
        $this->roles()->attach(Role::getByName($roles));

        return $this;
    }

    /**
     * @param $roles
     *
     * @return $this
     */
    public function removeRole($roles)
    {
        $this->roles()->detach(Role::getByName($roles));

        return $this;
    }
}
