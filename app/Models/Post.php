<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'status', 'logo', 'name', 'post_date', 'date_match', 'start_time', 'end_time', 'location'];

    //======== relationships with users =================================
    public function user()
    {
        return $this->belongsTo(User::class);
    }
      /**
     * Store a new post.
     *
     * @param \Illuminate\Http\Request $request
     * @param int|null $id
     * @return \App\Models\Post
     */

     //========  functions update and create =================================
    public static function store($request, $id = null)
    {
        $data = $request->only('name', 'post_date', 'date_match', 'start_time', 'end_time', 'location', 'user_id');

        if ($request->hasFile('logo')) {
            try {
                if ($request->logo && Storage::exists('public/' . $request->logo)) {
                    Storage::delete('public/' . $request->logo);
                }
    
                $file = $request->file('logo');
                $filename = time() . '.' . $file->extension();
                $file->storeAs('public/images', $filename);
                $data['logo'] = 'images/' . $filename;

            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to upload new logo: ' . $e->getMessage()], 500);
            }
        }
        if(Auth::id()){
            $data['user_id'] = Auth::id();
        }
        $data['status'] = false;
        $data = self::updateOrCreate(['id' => $id], $data);
        return $data;
    }
}
