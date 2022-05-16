<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OnlinePayment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'amount',
        'user_id ',
        'status',
        'gateway',
        'transaction_id',
        'bank_first_response',
        'bank_second_response',
    ];

}
