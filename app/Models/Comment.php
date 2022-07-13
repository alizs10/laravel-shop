<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['body', 'parent_id', 'status', 'commentable_id', 'commentable_type', 'seen', 'approved', 'author_id'];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function parent()
    {
        return $this->belongsTo($this, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany($this, 'parent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function likes()
    {
        return $this->morphMany('App\Models\Like', 'likable');
    }



    public const CAN_VIEW_ID = 221;
    public const CAN_ANSWER_ID = 222;
    public const CAN_UPDATE_ID = 223;
    public const CAN_DELETE_ID = 224;
    public const CAN_ALL_ID = 225;
}
