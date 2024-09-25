<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'phone_number', 'age'];
    public static function store($request, $id = null)
    {

        $data = $request->only('name', 'phone_number', 'age');
        $data = self::updateOrCreate(['id' => $id], $data);
        return $data;
    }
}
