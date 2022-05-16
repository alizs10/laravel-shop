<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RoleUser extends Pivot
{
    public $timestamps = false;
}
