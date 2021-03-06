<?php

namespace App\Models\Notify;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailFile extends Model
{
    protected $table = "public_mail_files";

    use HasFactory, SoftDeletes;
    
    protected $fillable = ['public_mail_id', 'file_path', 'file_size', 'file_type', 'file_name', 'file_description', 'file_save_path'];

    public function email()
    {
        return $this->belongsTo(Email::class, 'public_mail_id');
    }

    public const CAN_VIEW_ID = 163;
    public const CAN_CREATE_ID = 161;
    public const CAN_UPDATE_ID = 162;
    public const CAN_DELETE_ID = 164;
    public const CAN_ALL_ID = 165;
}
