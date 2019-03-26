<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Repositories\ApplicationRepository;
use Illuminate\Http\Request;

class ApplicationController extends Controller
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
        $paginator = Application::orderBy('id', 'desc')-> paginate(15);
        return view('ap.application.index', compact('paginator'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Application $application
     * @param ApplicationRepository $repository
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application, ApplicationRepository $repository)
    {
        $addictions = $repository->getAllAddictionsByAppId($application->id);
        $application = $repository->getApplicationWithData($application->id);
        dump($application, $addictions);
        return view('ap.application.show', compact('application','addictions'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        //
    }
}
