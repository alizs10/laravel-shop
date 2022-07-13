<?php

namespace App\Models\Content;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCategory extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $fillable = ['name', 'slug', 'description', 'image', 'status', 'tags'];

    protected $casts = ['image' => 'array'];


    public const CAN_VIEW_ID = 196;
    public const CAN_CREATE_ID = 197;
    public const CAN_UPDATE_ID = 198;
    public const CAN_DELETE_ID = 199;
    public const CAN_ALL_ID = 200;

}
