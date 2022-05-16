<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyValue extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'category_values';

    protected $fillable = [
        'value',
        'category_attribute_id',
        'product_id',
        'type',
        
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function attribute()
    {
        return $this->belongsTo(CategoryAttribute::class, 'category_attribute_id');
    }
}
