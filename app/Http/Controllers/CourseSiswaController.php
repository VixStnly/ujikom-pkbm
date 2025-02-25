<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseSiswaController extends Controller
{
    public function index()
    {
        return view('siswa.Course');
    }
}
