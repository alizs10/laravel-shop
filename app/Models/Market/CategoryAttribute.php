<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryAttribute extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'type', 'unit', 'cat_id'];


    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'cat_id');
    }

    public function values()
    {
        return $this->hasMany(PropertyValue::class, 'category_attribute_id');
    }
}
