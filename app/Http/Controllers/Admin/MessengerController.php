<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Messenger;
use Illuminate\Http\Request;

class MessengerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messenters = Messenger::all();
        return view('setting.messenger.index', compact('messengers'));
    }

    
}
