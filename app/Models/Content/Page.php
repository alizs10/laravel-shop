<?php

namespace App\Models\Content;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;

class Page extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $fillable = ['title', 'slug', 'body', 'status', 'tags'];

    public function url()
    {
        return Config::get('app.url') . '/' . $this->slug;
    }


    public const CAN_VIEW_ID = 216;
    public const CAN_CREATE_ID = 217;
    public const CAN_UPDATE_ID = 218;
    public const CAN_DELETE_ID = 219;
    public const CAN_ALL_ID = 220;

}
