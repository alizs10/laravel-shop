<?php

namespace App\Models\Market;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $fillable = ['name', 'slug', 'description', 'image', 'status', 'tags', 'parent_id', 'show_in_menu'];

    protected $casts = ['image' => 'array'];

    public function products()
    {
        return $this->hasMany(Product::class, 'cat_id');
    }

    public function parent()
    {
        return $this->belongsTo($this, 'parent_id');
    }
}
