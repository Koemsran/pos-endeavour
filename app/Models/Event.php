<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'start', 'end', 'user_id', 'date'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    
}
