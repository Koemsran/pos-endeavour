<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;
    protected $fillable = ['client_id', 'step_number'];
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
