<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'likes',
        'dislikes',
        'likable_id',
        'likable_type',
        'status',
    ];

    public function likable()
    {
        return $this->morphTo();
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->using(LikeUser::class);
    }
}
