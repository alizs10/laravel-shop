<?php

namespace App\Policies;

use App\Models\Content\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        $user_role = $user->roles()->where("name", "نویسنده")->first();

        return !empty($user_role);
    }


    public function view(User $user, Post $post)
    {
        return $user->id == $post->author_id;
    }

    public function create(User $user)
    {
        $user_role = $user->roles()->where("name", "نویسنده")->first();
        if ($user_role) {
            $permissions_ids = [];
            $permissions = $user_role->permissions;
            foreach ($permissions as $permission) {
                array_push($permissions_ids, $permission->id);
            }
            return in_array(Post::CAN_CREATE_ID, $permissions_ids);
        }

        return false;
    }

    public function update(User $user, Post $post)
    {
        return $user->id == $post->author_id;
    }

    public function delete(User $user, Post $post)
    {
        return $user->id == $post->author_id;
    }
}
