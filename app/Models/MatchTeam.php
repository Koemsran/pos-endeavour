<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MatchTeam extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'team_post_id', 'team_name', 'team_logo'];

    //============ relationships with teamPost =============================
    public function teamPost(){
        return $this->belongsTo(Post::class, 'team_post_id');
    }
    //============ methods store =============================
    public static function store($request){
        $data = $request->only('team_post_id', 'team_name'); // Removed 'team_logo' from the list of fields to be retrieved
    
        if ($request->hasFile('team_logo')) {
            $imageName = time() . '.' . $request->file('team_logo')->extension(); // Corrected to use 'team_logo' instead of 'image'
            $request->file('team_logo')->storeAs('public/images', $imageName); // Corrected to use 'team_logo' instead of 'image'
            $data['team_logo'] = 'images/' . $imageName; // Corrected to use 'team_logo' instead of 'image'
        }
    
        $data = self::create($data);
    
        return $data;
    }
    
}
