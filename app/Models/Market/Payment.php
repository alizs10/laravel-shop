<?php

namespace App\Models\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'amount',
        'user_id',
        'status',
        'type',
        'paymentable_id',
        'paymentable_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentable()
    {
        return $this->morphTo();
    }

    public function order()
    {
        return $this->hasOne(Order::class, "payment_id");
    }

    public function status()
    {
        switch ($this->status) {
            case '0':
                return "ناموفق";
                break;
            case '1':
                return "موفق";
                break;
            case '2':
                return "در انتظار پرداخت";
                break;
        }
    }

    public function type()
    {
        switch ($this->type) {
            case '0':
                return "آنلاین";
                break;
            case '1':
                return "آفلاین";
                break;
            case '2':
                return "در محل";
                break;
        }
    }

    public function transactionId()
    {
        switch ($this->type) {
            case '0':
                return $this->paymentable->transaction_id ?? '-';
                break;
            case '1':
                return $this->paymentable->transaction_id ?? '-';
                break;
            case '2':
                return "-";
                break;
        }
    }
    
    public function gateway()
    {
        switch ($this->type) {
            case '0':
                return $this->paymentable->gateway ?? '-';
                break;
            case '1':
                return "-";
                break;
            case '2':
                return "-";
                break;
        }
    }



    public const CAN_VIEW_ID = 251;
    public const CAN_CREATE_ID = 252;
    public const CAN_UPDATE_ID = 253;
    public const CAN_DELETE_ID = 254;
    public const CAN_ALL_ID = 255;

}
