<?php

namespace App\Models;

use App\Models\Admin\Market\Address;
use App\Models\Admin\Market\Order;
use App\Models\Admin\Market\OrderItem;
use App\Models\Admin\Market\Product;
use App\Models\Admin\Ticket\TicketAdmin;
use App\Models\Admin\User\Permission;
use App\Models\Admin\User\Role;
use App\Traits\ACL;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use Sluggable;
    use SoftDeletes;
    use ACL;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'email'
            ]
        ];
    }


    protected $fillable = ["first_name" , "last_name" , "mobile" , "status" ,"national_code" , "password" ,"email" ,"avatar" ,"activation" , "user_type" , "email_verified_at" , "mobile_verified_at"];
    protected $hidden = ["password" , "national_code"];

    public function ticketAdmin()
    {
        return $this->hasOne(TicketAdmin::class , "user_id" ,"id");
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function favorites()
    {
        return $this->belongsToMany(Product::class , "product_user" ,"user_id" , "product_id");
    }

    public function carts()
    {
        return $this->hasMany(CartItem::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
