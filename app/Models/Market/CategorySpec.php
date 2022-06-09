<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategorySpec extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'cat_id',
        'status',
        'default_value',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
