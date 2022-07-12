<?php

namespace App\Models\Content;

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
}
