<?php

namespace App\Models\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "user_id",
        "address_id",
        "address_object",
        "payment_id",
        "payment_object",
        "payment_type",
        "payment_status",
        "delivery_id",
        "delivery_object",
        "delivery_amount",
        "delivery_status",
        "delivery_date",
        "order_final_amount",
        "order_discount_amount",
        "coupon_id",
        "coupon_object",
        "order_coupon_discount_amount",
        "public_discount_id",
        "public_discount_object",
        "order_public_discount_amount",
        "order_total_products_discount_amount",
        "order_status",
    ];

    public function items() {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }
    
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function publicDiscount()
    {
        return $this->belongsTo(PublicDiscount::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    // attrs

    public function status()
    {
        switch ($this->order_status) {
            case '0':
                return 'در حال بررسی';
                break;
            case '1':
               return 'در حال پردازش';
                break;
            case '2':
               return 'در حال ارسال';
                break;
            case '3':
               return 'ارسال شده';
                break;
            case '4':
               return 'لغو شده';
                break;
            case '5':
               return 'مرجوع شده';
                break;


        }
    }
    public function deliveryStatus()
    {
        switch ($this->delivery_status) {
            case '0':
                return 'در حال آماده سازی';
                break;
            case '1':
               return 'در حال ارسال';
                break;
            case '2':
               return 'ارسال شده';
                break;
        }
    }
}
