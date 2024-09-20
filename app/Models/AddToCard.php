<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddToCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price',
        'total_amount',
    ];
    // ======================= Relationships =======================
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    // ======================= item list =======================
    public static function list()
    {
        return self::with('products')->get();
    }
    // ======================= Add To Cart =======================
    public static function addToCart($userId, $productId, $quantity)
    {
        $product = Product::findOrFail($productId);

        $cartItem = self::where('user_id', $userId)
                        ->where('product_id', $productId)
                        ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->total_amount = $cartItem->quantity * $cartItem->price;
            $cartItem->save();
        } else {
            $totalAmount = $product->price * $quantity;
            $cartItem = self::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $product->price,
                'total_amount' => $totalAmount
            ]);
        }

        return $cartItem;
    }
    
}

