<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ['image', 'name', 'phone_number', 'age'];
    public static function store($request, $id = null)
    {

        $data = $request->only('name', 'phone_number', 'age');
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov,wmv|max:20480',
            ]);
            $image = $request->file('image')->store('images', 'public');
            $data['image'] = Storage::url($image);
        } else {
            $data['image'] = $request->input('image');
        }

        $data = self::updateOrCreate(['id' => $id], $data);
        return $data;
    }
}
