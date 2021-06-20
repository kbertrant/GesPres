<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatController extends Controller
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

    public function medicamplusvendus()
    {
        return view('stat.medicamplusvendus');
    }
}
