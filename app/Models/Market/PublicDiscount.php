<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PublicDiscount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "title",
        "percentage",
        "maximum_discount",
        "minimum_order_amount",
        "status",
        "valid_from",
        "valid_until"
    ];
}
