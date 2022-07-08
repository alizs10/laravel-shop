<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;

class Menu extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'icon', 'parent_id', 'url', 'status'];

    public function url()
    {
        return Config::get('app.url') . '/' . $this->name;
    }

    public function parent($parent_id)
    {
        return $parent_name = Menu::find($parent_id)->name;
    }
}
