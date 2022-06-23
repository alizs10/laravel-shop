<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "user_id",
        "city_id",
        "address",
        "postal_code",
        "unit",
        "no",
        "addressee_name",
        "receiver_mobile",
        "receiver_name",
        "status",
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
