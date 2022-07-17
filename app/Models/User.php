<?php

namespace App\Models;

use App\Models\Market\Coupon;
use App\Models\Market\CouponUser;
use App\Models\Market\Favorite;
use App\Models\Market\Order;
use App\Models\Market\Product;
use App\Models\Ticket\Ticket;
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

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
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
    public function cart_items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Product::class, 'favorites')->using(Favorite::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class)->using(CouponUser::class);
    }


    public const CAN_VIEW_ID = 186;
    public const CAN_CREATE_ID = 187;
    public const CAN_UPDATE_ID = 188;
    public const CAN_DELETE_ID = 189;
    public const CAN_ALL_ID = 190;


}
