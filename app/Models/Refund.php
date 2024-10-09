<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;
    protected $fillable = [
        'progress_id',
        'client_id',
        'refund_reason',
    ];
    public function progress(){
        return $this->belongsTo(Progress::class, 'progress_id');
    }
    public function client(){
        return $this->belongsTo(Client::class, 'client_id');
    }
}
