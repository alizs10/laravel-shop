<?php

namespace App\Models\Content;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'question'
            ]
        ];
    }

    protected $fillable = ['question', 'slug', 'answer', 'status', 'tags'];


    public const CAN_VIEW_ID = 206;
    public const CAN_CREATE_ID = 207;
    public const CAN_UPDATE_ID = 208;
    public const CAN_DELETE_ID = 209;
    public const CAN_ALL_ID = 210;
}
