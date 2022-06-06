<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opt extends Model
{
    use HasFactory;

    protected $table = 'opt';

    protected $fillable = [
        'identifier',
        'user_id',
        'used',
        'code',
        'token'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
