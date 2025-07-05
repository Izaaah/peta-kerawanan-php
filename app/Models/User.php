<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'username', 'email', 'password', 'role'];

    protected $hidden = ['password'];

    public function getAuthIdentifierName()
    {
        return 'username';
    }

    // Role checking methods
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super-admin';
    }

    public function isAdministrator(): bool
    {
        return $this->role === 'administrator';
    }

    public function isOperator(): bool
    {
        return $this->role === 'operator';
    }

    public function hasRole($role): bool
    {
        return $this->role === $role;
    }
}
