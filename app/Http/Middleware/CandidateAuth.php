<?php

namespace App\Http\Middleware;

use App\Models\Candidate;
use Closure;

class CandidateAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = Candidate::whereRememberToken($request->cookie('candidate_token'))->first();
        if (empty($request->cookie('candidate_token'))){
            return redirect(route('registration.auth'));
        } else if(empty($token)){
            return redirect(route('registration.auth'));
        }
        return $next($request);
    }
}
