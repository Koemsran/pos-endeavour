<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = ['address', 'user_id', 'delivery_status'];

    //================ Define relationship with order ============================
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    //================ Define relationship with user ===========================
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //================ create delivery ============================
    public static function createDelivery(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'delivery_status' => 'required|in:pending,in_transit,delivered,failed',
        ]);

        $deliveryData = $request->all();
        $deliveryData['user_id'] = Auth::id();

        return self::create($deliveryData);
    }

    //================ update delivery ============================
    public static function updateDelivery(Request $request, string $id)
    {
        $request->validate([
            'address' => 'sometimes|required|string|max:255',
            'delivery_status' => 'sometimes|required|in:pending,in_transit,delivered,failed',
        ]);

        $delivery = self::findOrFail($id);
        $delivery->update($request->all());

        return $delivery;
    }
}
