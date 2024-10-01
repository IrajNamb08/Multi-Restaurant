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

    public function admin()
    {
        return view('admin');
    }
    public function restoAdmin()
    {
        return view('restoAdmin');
    }
    public function manager()
    {
        return view('manager');
    }
    public function cuisinier()
    {
        return view('cuisinier');
    }
}
