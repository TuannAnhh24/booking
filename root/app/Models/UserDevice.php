<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class UserDevice extends Model
{
    protected $table = 'user_devices';

    protected $fillable = [
        'user_id',
        'device_name',
        'device_type',
        'device_ip',
        'browser',
        'login_time',
        'last_active',
        'time_out',
        'status',
        'location' ,
    ];

    protected $casts = [
        'login_time' => 'datetime',
        'last_active' => 'datetime',
        'time_out' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isActive()
    {
        return $this->status === 'active';
    }

    public function updateLastActive()
    {
        $this->last_active = Carbon::now();
        $this->save();
    }

    public function isTimedOut()
    {
        return Carbon::now()->greaterThan($this->time_out);
    }

    public function logoutDevice()
    {
        $this->status = 'logged_out';
        $this->save();
    }
}
