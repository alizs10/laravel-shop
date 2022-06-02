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

    public function getPriceAttribute()
    {
        return $price = $this->product->price - ($this->product->price * $this->percentage / 100);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
