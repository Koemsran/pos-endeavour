<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\password;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        return view('setting.settings.index', compact('user'));
    }
    // ==================checking password=====================//
    public function checkPassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
        ]);

        // Get the currently authenticated user
        $user = Auth::user();
        if (!Hash::check($request->input('old_password'), $user->password)) {
            Cache::put('failed', 'Old password does not match our records.', 1000);
            return redirect()->back();
        } else {
            session(['password_change_modal' => true]);

            return view('setting.settings.edit');
        }
    }

    //======================Update password =================//
    public function updatePassword(Request $request)
    {
        $request->validate([
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Get the currently authenticated user
        $user = Auth::user();

        // Update the user's password
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        // Clear the password change session variable
        session()->forget('password_change_modal');

        return redirect()->route('settings.index')->with('success', 'Password successfully updated.');
    }



    /**
     * Show the form for creating a new setting.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('settings.create');
    }

    /**
     * Store a newly created setting in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validation can be added here if needed

        $setting = new Setting();
        $setting->key = $request->input('key');
        $setting->value = $request->input('value');
        $setting->email_address = $request->input('email_address');
        $setting->responsible = $request->input('responsible');
        $setting->email_notifications = $request->input('email_notifications', 0); // Assuming default is disabled

        $setting->save();

        return redirect()->route('settings.index')
            ->with('success', 'Setting created successfully.');
    }


    /**
     * Show the form for editing the specified setting.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $setting = Setting::findOrFail($id); // Assuming Setting is your model

        return view('settings.edit', compact('setting'));
    }

    /**
     * Remove the specified setting from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $setting = Setting::findOrFail($id); // Assuming Setting is your model
        $setting->delete();

        return redirect()->route('settings.index')
            ->with('success', 'Setting deleted successfully.');
    }
}
