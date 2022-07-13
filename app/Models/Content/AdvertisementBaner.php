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
        '0' => 'اسلایدشو (صفحه اصلی)',
        '1' => 'تبلیغ زیر محصولات شگفت انگیز',
        '2' => 'تبلیغ زیر محصولات پیشنهادی',
        '3' => 'تبلیغ زیر بازدید های اخیر',
    ];


    public const CAN_VIEW_ID = 226;
    public const CAN_CREATE_ID = 227;
    public const CAN_UPDATE_ID = 228;
    public const CAN_DELETE_ID = 229;
    public const CAN_ALL_ID = 230;
}
