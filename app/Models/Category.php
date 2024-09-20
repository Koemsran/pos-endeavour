<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use HasFactory;

    protected $fillable = [
        'name',
        'owner_id', // Add this field to fillable
    ];
    //================ Relationships============================
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function discounts()
    {
        return $this->hasManyThrough(Discount::class, Product::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    
}
