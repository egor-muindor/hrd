<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HeadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('control_panel.head_index');
    }
}
