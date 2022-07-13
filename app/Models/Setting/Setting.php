<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'keywords', 'icon', 'logo'];

    protected $casts = ['logo' => 'array', 'icon' => 'array'];

    public const CAN_VIEW_ID = 159;
    public const CAN_UPDATE_ID = 160;
}
