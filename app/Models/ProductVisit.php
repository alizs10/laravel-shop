<?php

namespace App\Models;

use App\Models\Market\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVisit extends Model
{
    use HasFactory;

    protected $fillable = ['ip_address', 'user_id', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
