<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['image', 'name', 'description', 'owner_id', 'price', 'color', 'size', 'category_id'];

    //============== show all products=============
    public function index(Request $request)
    {
        $date = $request->input('date');
        $status = $request->input('status');
        $ordersQuery = Order::query();

        if ($date) {
            $ordersQuery->whereDate('created_at', $date);
        }

        $orders = $ordersQuery->with(['user', 'products.colors', 'products.sizes'])->get();

        return view('setting.orders.index', compact('orders'));
    }

    //============ show the product by id =================
    public function show($id)
    {
        $order = Order::with(['user', 'products.colors', 'products.sizes'])->find($id);

        if (!$order) {
            return redirect()->route('admin.orders.index')->with('error', 'Order not found');
        }

        return view('setting.orders.show', compact('order'));
    }


    //========= relationship =============
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_colors', 'product_id', 'color_id');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_sizes', 'product_id', 'size_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'product_orders')
            ->withPivot('qty', 'color_id', 'size_id');
    }

    public function discounts()
    {
        return $this->belongsToMany(Discount::class, 'discount_products', 'product_id', 'discount_id')
            ->withTimestamps();
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Payment.php model

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addToCards()
    {
        return $this->hasMany(AddToCard::class);
    }

    public function getDiscountedPriceAttribute()
    {
        $originalPrice = $this->price;
        $discountedPrice = $originalPrice;

        foreach ($this->discounts as $discount) {
            $discountAmount = $originalPrice * ($discount->discount / 100);
            $discountedPrice -= $discountAmount;
            break;
        }

        return $discountedPrice;
    }

    protected $casts = [
        'color' => 'array', // Cast the 'color' attribute to array
        'size' => 'array',  // Cast the 'size' attribute to array
    ];


    public static function store($request, $id = null)
    {

        $data = $request->only('name', 'description', 'price', 'category_id', 'size', 'color');
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov,wmv|max:20480',
            ]);
            $image = $request->file('image')->store('images', 'public');
            $data['image'] = Storage::url($image);
        } else {
            $data['image'] = $request->input('image');
        }
        $data['owner_id'] = Auth::id();

        $product = self::updateOrCreate(['id' => $id], $data);
        return $product;
    }
}
