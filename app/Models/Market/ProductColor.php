<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductColor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'color_name',
        'color_code',
        'product_id',
        'price_increase',
        'status',
        'marketable_number',
        'frozen_number',
        'sold_number',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
