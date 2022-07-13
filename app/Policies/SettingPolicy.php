<?php

namespace App\Policies;

use App\Models\Setting\Setting;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingPolicy
{
    use HandlesAuthorization;

    
    public function index(User $user)
    {
        $permissions_ids = [];
        foreach ($user->roles as $role) {
            foreach ($role->permissions as $permission) {
                array_push($permissions_ids, $permission->id);
            }
        }

        return in_array(Setting::CAN_VIEW_ID, $permissions_ids);
    }


    public function update(User $user)
    {
        $permissions_ids = [];
        foreach ($user->roles as $role) {
            foreach ($role->permissions as $permission) {
                array_push($permissions_ids, $permission->id);
            }
        }

        return in_array(Setting::CAN_UPDATE_ID, $permissions_ids);
    }

}
