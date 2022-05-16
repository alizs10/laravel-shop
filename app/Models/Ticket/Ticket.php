<?php

namespace App\Models\Ticket;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'description',
        'seen',
        'status',
        'reference_id',
        'user_id',
        'cat_id',
        'priority_id',
        'ticket_id',

    ];



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function referencedTo()
    {
        return $this->belongsTo(TicketAdmin::class, 'reference_id');
    }

    public function parent()
    {
        return $this->belongsTo($this, 'ticket_id')->with('parent');
    }

    public function children()
    {
        return $this->hasMany($this, 'ticket_id')->with('children');
    }

    public function category()
    {
        return $this->belongsTo(TicketCategory::class, 'cat_id');
    }

    public function priority()
    {
        return $this->belongsTo(TicketPriority::class, 'priority_id');
    }
}
