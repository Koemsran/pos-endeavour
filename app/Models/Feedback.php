<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{

    // Fillable attributes for mass assignment
    protected $fillable = [
        'user_id', 'field_id', 'feedback_text'
    ];

    // Define relationship with User

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Define relationship with Field
    public function field()
    {
        return $this->belongsTo(Field::class, 'field_id');
    }


    public static function list()
    {
        return self::with(['user', 'field'])->get();
    }


    // Get feedback by field ID
    public static function getByField($fieldId)
    {
        return self::where('field_id', $fieldId)->firstOrFail();
    }


}
