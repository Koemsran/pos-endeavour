<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'action', 'comment'];


    //============== Methods store =============================================

    public static function store($request, $id = null){
        $data = $request->only('user_id', 'action', 'action_data');
        $data = self::updateOrCreate(['id' => $id], $data);
        return $data;
    }

}
