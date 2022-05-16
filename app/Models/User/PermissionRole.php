<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PermissionRole extends Pivot
{
    public $timestamps = false;
}
