<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'keywords', 'icon', 'logo'];

    protected $casts = ['logo' => 'array', 'icon' => 'array'];
}
