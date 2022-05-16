<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfflinePayment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'amount',
        'user_id ',
        'status',
        'transaction_id',
        'payment_date',
    ];

    public function payments()
    {
        return $this->morphMany(Payment::class, 'paymentable');
    }
}
