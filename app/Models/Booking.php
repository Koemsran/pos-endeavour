<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','field_id','booking_date', 'total_price','status','payment_status', 'start_time','end_time'];

    // ======================= Relationships =======================
    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function field()
    {
        return $this->belongsTo(Field::class, 'field_id');
    }
    public function options()
    {
        return $this->belongsToMany(Option::class, 'booking_options')
                    ->withPivot('qty')
                    ->withTimestamps();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
    
    // ======================= Methods create and update =======================
    public static function store($request, $id = null)
    {
        $data = $request->only('user_id', 'field_id', 'booking_date', 'start_time', 'end_time', 'total_price', 'status', 'payment_status');
        
        $booking = self::updateOrCreate(['id' => $id], $data);

        if ($request->has('options')) {
            $options = [];
            foreach ($request->options as $option) {
                $options[$option['id']] = ['qty' => $option['qty'] ?? null];
            }
            $booking->options()->sync($options);
        }

        return response()->json($booking->load('options'), 201);
    }
    
    
}
