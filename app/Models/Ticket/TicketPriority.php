<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketPriority extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'status'];


    public const CAN_VIEW_ID = 176;
    public const CAN_CREATE_ID = 177;
    public const CAN_UPDATE_ID = 178;
    public const CAN_DELETE_ID = 179;
    public const CAN_ALL_ID = 180;

}
