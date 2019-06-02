<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCandidateRequest;
use App\Mail\SendInvite;
use App\Models\Candidate;
use App\Models\Invite;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Mail;

class CandidateController extends Controller
{
    /**
     * CandidateController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Возвращает список соискателей
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidates = Candidate::paginate(25);
        return view('control_panel.candidates_list', compact('candidates'));
    }

}
