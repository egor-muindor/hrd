<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInviteRequest;
use App\Mail\SendInvite;
use App\Models\Invite;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Mail;

class InviteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invites = Invite::paginate(25);
        return view('control_panel.invite_list', compact('invites'));
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
     * @param StoreInviteRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInviteRequest $request)
    {
        $email = $request->input('email');
        $token = Hash::make($email);
        $invite = new Invite([
            'email' => $email,
            'token' => $token,
            'status' => 'Создано',
            'head_name' => Auth::user()->name
        ]);
        $invite->save();
        Mail::to($email)->queue((new SendInvite($invite))->subject('Регистрация в системе оформления документов Московского политеха')
            ->from(['address' => 'robot@muindor.com', 'name' => 'MosPolyTech robot']));
        return back()->with(['success' => 'Сообщение отправлено']);
    }

    public function retry(Request $request){
        $invite = Invite::findOrFail($request->input(['id']));
        $token = Hash::make($invite->email);
        $invite->update(['token' => $token]);
        Mail::to($invite->email)->queue((new SendInvite($invite))->subject('Регистрация в системе оформления документов Московского политеха')
            ->from(['address' => 'robot@muindor.com', 'name' => 'MosPolyTech robot']));
        return response(['message' => 'Отправлено']);
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
