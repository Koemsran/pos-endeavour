<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'owner_id', 'amount', 'method', 'code', 'currency', 'payment_date'];

    //========== relations with customer===============
    public function customer(){
        return $this->belongsTo(User::class, 'user_id');
    }
    //========== relations with owner=============
    public function owner(){
        return $this->belongsTo(User::class, 'owner_id');
    }
    //============= relations with order============
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    //========== relations with user============
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //============ relations with booking============
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    //============ static method for store or update============
    public static function store($request, $id=null){
        $data = $request->only('user_id', 'owner_id', 'amount', 'method', 'code', 'currency', 'payment_date');
        $data = self::updateOrCreate(['id' => $id], $data);
        return $data;
    }
    

  
}
