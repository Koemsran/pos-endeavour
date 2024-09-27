<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'sart', 'end', 'user_id', 'client_id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function client(){
        return $this->belongsTo(Client::class, 'client_id');
    }

    
}
