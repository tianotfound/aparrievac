<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evacsite;
use App\Models\Evacuee;

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
        $evacsites = Evacsite::withCount('evacuees')
                    ->select('id', 'sitename', 'lat', 'lang', 'status')
                    ->get();
        return view('home', compact('evacsites'));
    }

}
