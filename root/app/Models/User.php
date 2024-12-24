<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * Các thuộc tính có thể gán hàng loạt.
     *
     * @var array
     */

    protected $fillable = [
        'role_id',
        'user_name',
        'first_name',
        'last_name',
        'display_name',
        'email',
        'password',
        'address',
        'country_code',
        'phone_number',
        'gender',
        'birthday',
        'avatar',
        'nationality',
        'passport',
        'description',
        'status',
    ];

    /**
     * Các thuộc tính được ẩn khi chuyển đổi thành mảng hoặc JSON.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Các thuộc tính được chuyển đổi thành kiểu dữ liệu gốc.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'string',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function variants()
    {
        return $this->belongsToMany(Variant::class);
    }
    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'user_room', 'user_id', 'room_id');
    }
    public function promotions()
    {
        return $this->belongsToMany(Promotion::class, 'promotion_user', 'user_id', 'promotion_id');
    }
    public function destinations()
    {
        return $this->belongsToMany(Destination::class, 'user_destiantion', 'user_id', 'destination_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getGenderTextAttribute()
    {
        return match ($this->gender) {
            0 => __('content.editUserProfile.female'),
            1 => __('content.editUserProfile.male'),
            2 => __('content.editUserProfile.other'),
            default => __('content.editUserProfile.Unknown'),
        };
    }
    public function devices()
    {
        return $this->hasMany(UserDevice::class);
    }
    public function room_booking()
    {
        return $this->belongsToMany(RoomBooking::class, 'user_room_booking', 'user_id', 'booking_id');

    }
}
