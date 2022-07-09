<?php

namespace App\Models\Market;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use HasFactory, SoftDeletes;


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

    public function children()
    {
        return $this->hasMany($this, 'parent_id');
    }

    public function attributes()
    {
        return $this->hasMany(CategoryAttribute::class, 'cat_id');
    }

    public function specs()
    {
        return $this->hasMany(CategorySpec::class, 'cat_id');
    }
}
