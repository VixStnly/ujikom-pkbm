<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FisologiController extends Controller
{
        /**
     * Show the Visi page.
     */
    public function index()
    {
        return view('landing.Fisologi');
    }
}
