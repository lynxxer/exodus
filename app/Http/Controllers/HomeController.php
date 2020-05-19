<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('home');
    }
    
    public function adminlte() {

        return view('adminlte');
    }

    public function map() {

        return view('map');
    }

    public function heat() {
        return view('heatmap');
    }
    
    public function corona() {
        return view('corona');
    }

    public function try() {
        return view('try');
    }
}
