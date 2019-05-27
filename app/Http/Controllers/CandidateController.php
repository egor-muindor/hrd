<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCandidateRequest;
use App\Models\Candidate;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CandidateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Candidate::all();
        return view('control_panel.index', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('control_panel.create_candidate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCandidateRequest $request
     * @return void
     * @throws \Exception
     */
    public function store(StoreCandidateRequest $request)
    {
//        dd($request);
//        dd(Auth::user()->name);
        $data = [
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'head_name' => Auth::user()->name,
        ];


        $newCandidate = new Candidate($data);
        $result = $newCandidate->save();
        if ($result) {
            return back()->with(['success' => 'Кандидат успешно добавлен']);
        }

        return back()->withInput()->withErrors('Ошибка сохранения');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
