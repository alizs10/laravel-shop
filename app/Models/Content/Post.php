<?php

namespace App\Models\Content;

use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = ['title', 'slug', 'summary', 'body', 'image', 'status', 'commentable', 'tags', 'published_at', 'author_id', 'cat_id'];

    protected $casts = ['image' => 'array'];

    public function postCategory()
    {
        return $this->BelongsTo(PostCategory::class, 'cat_id');
    }

    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }


    public const CAN_VIEW_ID = 201;
    public const CAN_CREATE_ID = 202;
    public const CAN_UPDATE_ID = 203;
    public const CAN_DELETE_ID = 204;
    public const CAN_ALL_ID = 205;

}
