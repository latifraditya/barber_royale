<?php

namespace App\Models;

use App\Models\Booking;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    
    public function roles() {
      return $this->belongsToMany(Role::class, 'user_role');
    }

    public function hasRole($role) {
      // Mengecek apakah pengguna memiliki peran tertentu
      return null !== $this->roles()->where('name', $role)->first();
    }

    public function hasAnyRole($roles) {
        // Mengecek apakah pengguna memiliki salah satu dari beberapa peran
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    // public function authorizeRoles($roles) {
    //   if (is_array($roles)) {
    //       // Mengecek apakah pengguna memiliki salah satu peran yang ada di array
    //       if (!$this->hasAnyRole($roles)) {
    //           abort(403, 'This action is unauthorized');
    //       }
    //   } else {
    //       // Mengecek apakah pengguna memiliki peran yang diberikan
    //       if (!$this->hasRole($roles)) {
    //           abort(403, 'This action is unauthorized');
    //       }
    //   }
    //   return true;
    // }


    public function bookings() {
        return $this->hasMany(Booking::class);
    }
}
