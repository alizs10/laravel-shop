<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdvertisementBaner extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'image',
        'url',
        'status',
        'position'
    ];

    protected $casts = ['image' => 'array'];

    public static $positions = [
        '0' => 'اسلایدشو صفحه اصلی',
        '1' => 'صفحه اصلی کنار اسلایدشو',
        '2' => 'صفحه اصلی وسط',
        '3' => 'صفحه اصلی پایین',
    ];
}
