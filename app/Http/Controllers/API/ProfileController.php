<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {   dd(Auth::user(), 'update', $request);
        $user = Auth::user();
        $validated = $request->validate([
            'name'=>'required',
            'email' => 'required|email|unique:users,email,'.$user->id.',id',
        ]);
        if($request->password != null){
            $request->validate([
                'password' => 'required|confirmed'
            ]);
            $validated['password'] = bcrypt($request->password);
        }

        if($request->hasFile('profile')){
            if($name = $this->saveImage($request->profile)){
                $validated['profile'] = $name;
            }
        }
        $user->seff::update($validated);
        return response()->json(['success' => true, 'message' =>'Profile updated successfully']);
    }
    protected function saveImage($image)
    {
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('profiles'), $filename);
        return $filename;
    }
    
}
