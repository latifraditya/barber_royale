<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Booking;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasRole($role) {
      // Mengecek apakah pengguna memiliki peran tertentu
      return null !== $this->roles()->where('name', $role)->first();
    }

    public function hasAnyRole($roles) {
        // Mengecek apakah pengguna memiliki salah satu dari beberapa peran
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    public function bookings() {
        return $this->hasMany(Booking::class);
    }
}
