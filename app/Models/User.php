<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
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
        'phone_number',
        'profile',
        'qr', 
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
        $imagePath = null;
        if ($request->hasFile('qr')) {
            $request->validate([
                'qr' => 'mimes:jpeg,png,jpg,gif,svg|max:20480',
            ]);
            $imagePath = $request->file('qr')->store('images', 'public');
        }
        $user = self::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'password'          => bcrypt($request->password),
            'phone_number'      => $request->phone_number,
            'qr'                => $imagePath ? $imagePath: null,
            'email_verified_at' => now(),
            'remember_token'    => Str::random(20),
        ]);
    
        if ($request->roles) {
            $user->assignRole($request->roles);
        } else {
            $user->assignRole('owner');
        }

        return $user;
    }

    //============== reationships ===========================
    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class);
    }

    public function fields()
    {
        return $this->hasMany(Field::class, 'owner_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'owner_id');
    }
    public function categories()
    {
        return $this->hasMany(Category::class, 'owner_id');
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
    }
    public function isCustomer()
    {
        return $this->hasRole('customer');
    }
    public function addToCards()
    {
        return $this->hasMany(AddToCard::class);
    }

    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }

    public function payments()
    {
        return $this->hasManyThrough(Payment::class, Product::class);
    }
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
    
}
