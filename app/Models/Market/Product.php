<?php

namespace App\Models\Market;

use App\Http\Services\CartServices;
use App\Http\Services\ProductServices;
use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;


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

    public function getProductPriceAttribute()
    {
        $prices = $this->getPrice([], true);
        return $prices['product_price'];
    }

    public function getUltimatePriceAttribute()
    {
        $prices = $this->getPrice([], true);
        return $prices['ultimate_price'];
    }

    public function getSoldAttribute()
    {
        return $this->isMarketable([], true);
    }

    public function isFavorite($user_id)
    {
        $user = User::find($user_id);
        $is_favorite = $user->favorites()->where('product_id', $this->id)->first();
        return !empty($is_favorite) ? true : false;
    }

    public function isInCart($attributes, $default_attributes = false)
    {
        $cartServices = new CartServices();
        return $cartServices->isInCart($this, $attributes, $default_attributes);
    }

    public function getPrice($attributes, $default_attributes = false)
    {
        $productServices = new ProductServices();
        return $productServices->getPrice($this, $attributes, $default_attributes);
    }

    public function isMarketable($attributes, $default_attributes = false)
    {
        $productServices = new ProductServices();
        return $productServices->isMarketable($this, $attributes, $default_attributes);
    }

    public function getSoldNumber($attributes, $default_attributes = false)
    {
        $productServices = new ProductServices();
        return $productServices->getSoldNumber($this, $attributes, $default_attributes);
    }



    public const CAN_VIEW_ID = 266;
    public const CAN_CREATE_ID = 267;
    public const CAN_UPDATE_ID = 268;
    public const CAN_DELETE_ID = 269;
    public const CAN_ALL_ID = 270;


}
