<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'status'];

    public function users()
    {
        return $this->belongsToMany(User::class)->using(RoleUser::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->using(PermissionRole::class);
    }

}
