<?php

namespace App\Models\Ticket;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketAdmin extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public const CAN_VIEW_ID = 171;
    public const CAN_CREATE_ID = 172;
    public const CAN_UPDATE_ID = 173;
    public const CAN_DELETE_ID = 174;
    public const CAN_ALL_ID = 175;

}
