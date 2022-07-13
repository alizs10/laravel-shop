<?php

namespace App\Models\Notify;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
{
    protected $table = "public_mail";

    use HasFactory, SoftDeletes;
    
    protected $fillable = ['subject', 'body', 'published_at', 'status'];

    public function files()
    {
        return $this->hasMany(EmailFile::class, 'public_mail_id');
    }

    public const CAN_VIEW_ID = 151;
    public const CAN_CREATE_ID = 149;
    public const CAN_UPDATE_ID = 150;
    public const CAN_DELETE_ID = 152;
    public const CAN_ALL_ID = 153;
}
