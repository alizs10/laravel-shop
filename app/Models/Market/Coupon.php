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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
