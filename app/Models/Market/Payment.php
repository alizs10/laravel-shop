<?php

namespace App\Models\Market;

use App\Models\User;
use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'amount',
        'user_id ',
        'status',
        'type',
        'paymentable_id',
        'paymentable_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $status = $this->status == 0 ? "ناموفق" : "موفق";
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
                return OnlinePayment::find($this->paymentable_id)->transaction_id;
                break;
            case '1':
                return OfflinePayment::find($this->paymentable_id)->transaction_id;
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
                return OnlinePayment::find($this->paymentable_id)->gateway;
                break;
            case '1':
                return "-";
                break;
            case '2':
                return "-";
                break;
        }
    }
}
