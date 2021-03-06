<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->using(PermissionRole::class);
    }
}
