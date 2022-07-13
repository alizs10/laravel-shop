<?php

namespace App\Policies\Content;

use App\Models\Content\AdvertisementBaner;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdvertisementBanerPolicy
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

        return in_array(AdvertisementBaner::CAN_VIEW_ID, $permissions_ids) || in_array(AdvertisementBaner::CAN_ALL_ID, $permissions_ids);
    }
   
    public function create(User $user)
    {
        $permissions_ids = [];
        foreach ($user->roles as $role) {
            foreach ($role->permissions as $permission) {
                array_push($permissions_ids, $permission->id);
            }
        }

        return in_array(AdvertisementBaner::CAN_CREATE_ID, $permissions_ids) || in_array(AdvertisementBaner::CAN_ALL_ID, $permissions_ids);
    }

  
    public function update(User $user)
    {
        $permissions_ids = [];
        foreach ($user->roles as $role) {
            foreach ($role->permissions as $permission) {
                array_push($permissions_ids, $permission->id);
            }
        }

        return in_array(AdvertisementBaner::CAN_UPDATE_ID, $permissions_ids) || in_array(AdvertisementBaner::CAN_ALL_ID, $permissions_ids);
    }

    public function delete(User $user)
    {
        $permissions_ids = [];
        foreach ($user->roles as $role) {
            foreach ($role->permissions as $permission) {
                array_push($permissions_ids, $permission->id);
            }
        }

        return in_array(AdvertisementBaner::CAN_DELETE_ID, $permissions_ids) || in_array(AdvertisementBaner::CAN_ALL_ID, $permissions_ids);
    }
}
