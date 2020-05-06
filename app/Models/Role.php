<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table    = 'roles';
    public $timestamps  = false;
    protected $fillable = [
        'name', 'slug', 'permissions','status',
    ];
    protected $casts = [
        'permissions' => 'array',
    ];

    public function users()
    {
        return $this->belongsToMany("App\User", 'role_users');
    }

    public function hasAccess(array $permissions): bool
    {
        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission)) {
                return true;
            }

        }
        return false;
    }

    private function hasPermission(string $permission): bool
    {
        return $this->permissions[$permission] ?? false;
    }
}
