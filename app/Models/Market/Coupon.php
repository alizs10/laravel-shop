<?php

namespace App\Models\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "code",
        "amount",
        "amount_type",
        "user_id",
        "type",
        "maximum_discount",
        "status",
        "valid_from",
        "valid_until"
    ];

    protected $casts = ["valid_from" => "timestamp"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public const CAN_VIEW_ID = 236;
    public const CAN_CREATE_ID = 237;
    public const CAN_UPDATE_ID = 238;
    public const CAN_DELETE_ID = 239;
    public const CAN_ALL_ID = 240;

}
