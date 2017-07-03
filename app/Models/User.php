<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'first_name',
        'last_name',
        'timezone',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $dates = [
        'last_login_at',
    ];

    public function getFullNameAttribute()
    {
        $parts = [
            data_get($this, 'first_name'),
            data_get($this, 'last_name'),
        ];

        return preg_replace('/\s+/', ' ', implode(' ', $parts));
    }

    public function entries()
    {
        return $this->hasMany(DateEntry::class);
    }

    public function weeklyEntries($year = null, $week = null)
    {
        return $this->hasMany(DateEntry::class)
            ->inWeek($year, $week);
    }
}
