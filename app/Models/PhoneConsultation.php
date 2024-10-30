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
        'source',
        'ielts',
        'hsk',
        'grade',
        'major',
        'university1',
        'university2',
        'program_looking',
        'prefer_country',
    ];
    
}
