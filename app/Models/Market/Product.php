<?php

namespace App\Models\Market;

use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
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

    protected $fillable = [
        'name',
        'slug',
        'introduction',
        'image',
        'status',
        'tags',
        'length',
        'height',
        'width',
        'weight',
        'price',
        'marketable',
        'marketable_number',
        'frozen_number',
        'sold_number',
        'brand_id',
        'cat_id',
        'published_at',
    ];

    protected $casts = ['image' => 'array'];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'cat_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function gallery()
    {
        return $this->hasMany(ProductGallery::class, 'product_id');
    }

    public function colors()
    {
        return $this->hasMany(ProductColor::class, 'product_id');
    }

    public function metas()
    {
        return $this->hasMany(ProductMeta::class, 'product_id');
    }

    public function specs()
    {
        return $this->hasMany(ProductSpec::class, 'product_id');
    }

    public function amazingSale()
    {
        return $this->hasOne(AmazingSale::class) ?? false;
    }

    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    public function properties()
    {
        return $this->hasMany(PropertyValue::class, 'product_id');
    }

    public function isFavorite($user_id)
    {
        $user = User::find($user_id);
        $is_favorite = $user->favorites()->where('product_id', $this->id)->first();
        return !empty($is_favorite) ? true : false;
    }
}
