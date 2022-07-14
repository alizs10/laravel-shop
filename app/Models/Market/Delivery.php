<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delivery extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "delivery";

    protected $fillable = [
        'name',
        'amount',
        'delivery_time',
        'delivery_time_unit',
        'status'
    ];


    public const CAN_VIEW_ID = 231;
    public const CAN_CREATE_ID = 232;
    public const CAN_UPDATE_ID = 233;
    public const CAN_DELETE_ID = 234;
    public const CAN_ALL_ID = 235;

}
