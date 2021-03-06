<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'persian_name',
        'original_name',
        'logo',
        'slug',
        'tags',
        'status'
    ];

    protected $casts = ['logo' => 'array'];


    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }

    public const CAN_VIEW_ID = 271;
    public const CAN_CREATE_ID = 272;
    public const CAN_UPDATE_ID = 273;
    public const CAN_DELETE_ID = 274;
    public const CAN_ALL_ID = 275;


}
