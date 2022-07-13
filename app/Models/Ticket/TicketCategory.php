<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'status'];

    public const CAN_VIEW_ID = 181;
    public const CAN_CREATE_ID = 182;
    public const CAN_UPDATE_ID = 183;
    public const CAN_DELETE_ID = 184;
    public const CAN_ALL_ID = 185;

}
