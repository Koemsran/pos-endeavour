<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //===============store user ================
    public static function store($request)
    {
        $user = self::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'password'          => bcrypt($request->password),
            'email_verified_at' => now(),
            'remember_token'    => Str::random(20),
        ]);
    
        if ($request->roles) {
            $user->assignRole($request->roles);
        } else {
            $user->assignRole('user');
        }

        return $user;
    }

    //============== reationships ===========================
    public function isAdmin()
    {
        return $this->hasRole('admin');
    }
    public function isCustomer()
    {
        return $this->hasRole('customer');
    }

}
