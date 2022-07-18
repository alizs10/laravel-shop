<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PublicDiscount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "title",
        "percentage",
        "status",
        "valid_from",
        "valid_until"
    ];


    public const CAN_VIEW_ID = 246;
    public const CAN_CREATE_ID = 247;
    public const CAN_UPDATE_ID = 248;
    public const CAN_DELETE_ID = 249;
    public const CAN_ALL_ID = 250;

}
