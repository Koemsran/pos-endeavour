<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'field_id', 'booking_id', 'title', 'start', 'end'];

    //================= // Define relationship with booking =================
    public function booking(){
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    //================= Static Function store ==================
    public static function store($request, $id=null){
        $data = $request->only('field_id', 'booking_id', 'title', 'start', 'end');
        $data = self::updateOrCreate(['id' => $id], $data);
        return $data;
    }
}
