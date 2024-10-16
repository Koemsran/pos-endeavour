<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeConsultation extends Model
{
    use HasFactory;
    protected $fillable = [
        'progress_id',
        'name',
        'age',
        'phone_number',
        'school',
        'education_level',
        'language_test',
        'prefer_university',
        'major',
        'address',
        'program_looking',
        'prefer_country',
    ];
    public function progress(){
        return $this->belongsTo(Progress::class, 'progress_id');
    }
    public function client(){
        return $this->belongsTo(Client::class, 'client_id');
    }
    
}
