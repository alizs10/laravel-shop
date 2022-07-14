<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AmazingSale extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "product_id",
        "percentage",
        "status",
        "valid_from",
        "valid_until"
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getPriceAttribute()
    {
        return $price = $this->product->price - ($this->product->price * $this->percentage / 100);
    }

    
    public const CAN_VIEW_ID = 241;
    public const CAN_CREATE_ID = 242;
    public const CAN_UPDATE_ID = 243;
    public const CAN_DELETE_ID = 244;
    public const CAN_ALL_ID = 245;
}
