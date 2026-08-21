<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public $timestamps = true;

    /**
     * Get permissions for this role
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }

    /**
     * Get users with this role
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'role_user');
    }

    /**
     * Assign permission to role
     */
    public function assignPermission(Permission $permission): self
    {
        if (!$this->permissions()->where('id', $permission->id)->exists()) {
            $this->permissions()->attach($permission);
        }
        return $this;
    }

    /**
     * Remove permission from role
     */
    public function removePermission(Permission $permission): self
    {
        $this->permissions()->detach($permission);
        return $this;
    }
}
