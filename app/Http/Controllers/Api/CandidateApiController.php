<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CandidateStatusUpdateRequest;
use App\Models\Candidate;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;
use SoapClient;

class CandidateApiController extends Controller
{
    public function updateStatus(CandidateStatusUpdateRequest $request){
        $candidate = Candidate::whereUncialId($request->input('id'))->firstOrFail();
        $candidate->update(['status' => $request->input('status')]);
        return response('OK');
    }
}
