<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HeadController extends Controller
{
    /**
     * HeadController constructor.
     * Защищает функции ПУ руководителя
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Возвращает главную страницу панели управления руководителя
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('control_panel.head_index');
    }
}
