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


    public const CAN_VIEW_ID = 211;
    public const CAN_CREATE_ID = 212;
    public const CAN_UPDATE_ID = 213;
    public const CAN_DELETE_ID = 214;
    public const CAN_ALL_ID = 215;
}
