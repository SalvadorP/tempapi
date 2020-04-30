<?php

namespace App\Http\Controllers;

class FrontController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        // die('Front Controller');
        return view('frontpage');
    }


}
