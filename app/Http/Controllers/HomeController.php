<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evacsite;    

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $evacsites = Evacsite::all();
        return view('home', compact('evacsites'));
    }

    public function getEvacSites()
    {
        return EvacSite::select('name', 'latitude as lat', 'longitude as lang')->get();
    }
}
