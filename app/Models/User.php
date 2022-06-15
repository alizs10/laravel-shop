<?php

namespace App\Models;

use App\Models\Ticket\TicketAdmin;
use App\Models\User\Role;
use App\Models\User\RoleUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'mobile',
        'email',
        'national_code',
        'password',
        'profile_photo_path',
        'activation',
        'activation_date',
        'verification_code',
        'user_type',
        'status',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_path',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function ticketAdmin()
    {
        return $this->hasOne(TicketAdmin::class, 'user_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class)->using(RoleUser::class);
    }

    public function likes()
    {
        return $this->belongsToMany(Like::class, 'like_user', 'likable_id', 'user_id')->using(LikeUser::class);
    }

    public function opt()
    {
        return $this->hasOne(Opt::class);
    }

}
