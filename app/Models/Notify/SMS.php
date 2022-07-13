<?php

namespace App\Models\Notify;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SMS extends Model
{

    protected $table = "public_sms";

    use HasFactory, SoftDeletes;
    
    protected $fillable = ['title', 'body', 'published_at', 'status'];

    public const CAN_VIEW_ID = 154;
    public const CAN_CREATE_ID = 155;
    public const CAN_UPDATE_ID = 156;
    public const CAN_DELETE_ID = 157;
    public const CAN_ALL_ID = 158;
    
}
