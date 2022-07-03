<?php

namespace App\Models;

use App\Http\Services\CartServices;
use App\Models\Market\Product;
use App\Models\Market\ProductColor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ip_address',
        'user_id',
        'product_id',
        'color_id',
        'guaranty_id',
        'number',
    ];

    protected $appends = ['item_product'];


    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function color()
    {
        return $this->belongsTo(ProductColor::class, 'color_id');
    }

    public function cartItemSelectedAttributes()
    {
        return $this->hasMany(CartItemSelectedAttribute::class, 'cart_item_id');
    }

    public function getItemProductAttribute()
    {
        return $this->product->toArray();
    }

    public function itemAttributes()
    {
        $cartServices = new CartServices();
        return $cartServices->getAttributes($this);
    }
}
