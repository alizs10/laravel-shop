<?php

namespace App\Models\Market;

use App\Http\Services\CartServices;
use App\Http\Services\OrderServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_id',
        'order_id',
        'product_object',
        'amazing_sale_id',
        'amazing_sale_object',
        "public_discount_id",
        "public_discount_object",
        'color_id',
        'guaranty_id',
        'number',
        'product_unit_price',
        'final_product_price',
        'final_total_price',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function color()
    {
        return $this->belongsTo(ProductColor::class, 'color_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);

    }

    public function orderItemSelectedAttributes()
    {
        return $this->hasMany(OrderItemSelectedAttributes::class, 'order_item_id');
    }

    public function itemAttributes()
    {
        $orderServices = new OrderServices();
        return $orderServices->getAttributes($this);
    }


    public function getItemPrice()
    {
        $orderServices = new OrderServices();
        return $orderServices->getItemPrice($this);
    }
    
    public function getDiscountAmountAttribute()
    {
        $prices = $this->getItemPrice();
        return $prices['discount_amount'];
    }

    public function getUltimatePriceAttribute()
    {
        $prices = $this->getItemPrice();
        return $prices['ultimate_price'];
    }

}
