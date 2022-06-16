<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItemSelectedAttribute extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'cart_item_id',
        'category_attribute_id',
        'category_value_id',
        'value',
    ];


    public function cart_item()
    {
        return $this->belongsTo(CartItem::class, 'cart_item_id');
    }
    
}
