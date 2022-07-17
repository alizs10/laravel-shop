<?php

namespace App\Policies\Ticket;

use App\Models\Ticket\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
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

        return in_array(Ticket::CAN_VIEW_ID, $permissions_ids) || in_array(Ticket::CAN_ALL_ID, $permissions_ids);
    }

    public function view(User $user, Ticket $ticket)
    {
        $permissions_ids = [];
        foreach ($user->roles as $role) {
            foreach ($role->permissions as $permission) {
                array_push($permissions_ids, $permission->id);
            }
        }
        return $user->id == $ticket->referencedTo->user_id || in_array(Ticket::CAN_ALL_ID, $permissions_ids);
    }

   
    public function answer(User $user)
    {
        $permissions_ids = [];
        foreach ($user->roles as $role) {
            foreach ($role->permissions as $permission) {
                array_push($permissions_ids, $permission->id);
            }
        }

        return in_array(Ticket::CAN_ANSWER_ID, $permissions_ids) || in_array(Ticket::CAN_ALL_ID, $permissions_ids);
    }

  
    public function update(User $user)
    {
        $permissions_ids = [];
        foreach ($user->roles as $role) {
            foreach ($role->permissions as $permission) {
                array_push($permissions_ids, $permission->id);
            }
        }

        return in_array(Ticket::CAN_UPDATE_ID, $permissions_ids) || in_array(Ticket::CAN_ALL_ID, $permissions_ids);
    }

    public function delete(User $user)
    {
        $permissions_ids = [];
        foreach ($user->roles as $role) {
            foreach ($role->permissions as $permission) {
                array_push($permissions_ids, $permission->id);
            }
        }

        return in_array(Ticket::CAN_DELETE_ID, $permissions_ids) || in_array(Ticket::CAN_ALL_ID, $permissions_ids);
    }
}
