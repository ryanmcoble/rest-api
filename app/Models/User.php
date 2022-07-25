<?php

namespace App\Models;

use App\Models\Marketplace\PaymentMethod;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'profile_image_id',
        'default_payment_method_id',
        'name',
        'email',
        'password',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
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
     * Profile image for a user
     */
    public function profileImage()
    {
        return $this->hasOne(Image::class, 'id', 'profile_image_id');
    }

    /**
     * Default method of payment for a user
     *
     * @return void
     */
    public function defaultPaymentMethod()
    {
        return $this->hasOne(PaymentMethod::class, 'id', 'default_payment_method_id');
    }
}
