<?php

namespace App\Policies\Content;

use App\Models\Content\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
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

        return in_array(Post::CAN_VIEW_ID, $permissions_ids) || in_array(Post::CAN_ALL_ID, $permissions_ids);
    }
   
    public function create(User $user)
    {
        $permissions_ids = [];
        foreach ($user->roles as $role) {
            foreach ($role->permissions as $permission) {
                array_push($permissions_ids, $permission->id);
            }
        }

        return in_array(Post::CAN_CREATE_ID, $permissions_ids) || in_array(Post::CAN_ALL_ID, $permissions_ids);
    }

  
    public function update(User $user, Post $post)
    {
        $permissions_ids = [];
        foreach ($user->roles as $role) {
            foreach ($role->permissions as $permission) {
                array_push($permissions_ids, $permission->id);
            }
        }

        return ($user->id == $post->author_id) || in_array(Post::CAN_ALL_ID, $permissions_ids);
    }

    public function delete(User $user, Post $post)
    {
        $permissions_ids = [];
        foreach ($user->roles as $role) {
            foreach ($role->permissions as $permission) {
                array_push($permissions_ids, $permission->id);
            }
        }

        return ($user->id == $post->author_id) || in_array(Post::CAN_ALL_ID, $permissions_ids);
    }
}
