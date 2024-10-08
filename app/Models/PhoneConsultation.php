<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneConsultation extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'age',
        'phone_number',
        'progress_id',
        'status',
        'source',
        'ielts',
        'hsk',
        'grade',
        'major',
        'prefer_school',
        'program_looking',
        'prefer_country',
    ];
    
}
