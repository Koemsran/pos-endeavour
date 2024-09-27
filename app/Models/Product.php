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
    protected $fillable = ['image', 'name', 'description', 'price', 'category_id'];


    //========= relationship =============
    public function category()
    {
        return $this->belongsTo(Category::class);
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

    public static function store($request, $id = null)
    {

        $data = $request->only('name', 'description', 'price', 'category_id');
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('images', 'public');
            $data['image'] = Storage::url($image);
        } else {
            $data['image'] = $request->input('image');
        }

        $product = self::updateOrCreate(['id' => $id], $data);
        return $product;
    }
}
