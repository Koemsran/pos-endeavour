<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    //============= relationship with customer============
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'user_id');
    }
    //============= relationship with user============
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //============= relationship many to many============
    public function products()
    {
        // return $this->belongsToMany(Product::class)->withPivot('qty', 'color_id', 'size_id');
        return $this->belongsToMany(Product::class, 'product_orders')
            ->withPivot('qty', 'color_id', 'size_id');
    }

    //============= createOrder ===============
    public static function createOrder($validatedData)
    {
        $user = Auth::user();

        $order = new self();
        $order->user_id = $user->id;
        $order->order_date = now()->format('Y-m-d');
        $product = Product::findOrFail($validatedData['product_id']);
        $totalAmount = $product->price * $validatedData['qty'];
        $order->total_amount = $totalAmount;
        $order->save();

        

        // Associate product with color and size
        $order->products()->attach($product, [
            'qty' => $validatedData['qty'],
            'color_id' => $validatedData['color_id'],
            'size_id' => $validatedData['size_id'],
        ]);

        return $order;
    }


    public function cancelOrder()
    {
        if ($this->order_status !== 'cancelled') {
            $this->order_status = 'cancelled';
            $this->save();
            return ['message' => 'Order cancelled successfully'];
        } else {
            return ['message' => 'Order is already cancelled'];
        }
    }

    public function reactivate()
    {
        if ($this->order_status === 'cancelled') {
            $this->order_status = 'confirmed';
            $this->save();
            return true;
        }
        return false;
    }
}



// public static function createOrder($validatedData)
    // {
    //     $user = Auth::user();

    //     $order = new self();
    //     $order->user_id = $user->id;
    //     $order->order_date = now()->format('Y-m-d');
    //     $order->save();

    //     $product = Product::findOrFail($validatedData['product_id']);

    //     // Associate product with color and size
    //     $order->products()->attach($product, [
    //         'qty' => $validatedData['qty'],
    //         'color_id' => $validatedData['color_id'],
    //         'size_id' => $validatedData['size_id'],
    //     ]);

    //     return $order;
    // }
