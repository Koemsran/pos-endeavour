<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Field extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'location',
        'image',
        'price',
        'field_type',
        'owner_id',
        'province',
    ];
    //============= relationship =============================
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
    public function fetch() {
        
        return self::all();
    }
    public function owner(){
        return $this->belongsTo(User::class, 'owner_id');
    }

    //============ custom function store =============================
    public static function store($request, $id = null) {

        $data = $request->only('name', 'location', 'price', 'field_type','owner_id', 'province');
        $imageName = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/images', $imageName);
        $data['image'] = 'images/' . $imageName;
        $data = self::updateOrCreate(['id' => $id], $data);
        return $data;
    }
    
}
