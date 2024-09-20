<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SlideShow;
use Illuminate\Http\Request;

class SlideShowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slides = SlideShow::all();
        return response()->json($slides);
    }


}
