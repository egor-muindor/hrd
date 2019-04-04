<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeStatusRequest;
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Models\Application;
use App\Repositories\ApplicationRepository;
use Carbon\Carbon;
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


    public function unchecked()
    {
        $paginator = Application::whereStatus(0)->orderBy('id', 'desc')-> paginate(15);
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
//        dump($application, $addictions);
        return view('ap.application.show', compact('application','addictions'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ApplicationRepository $repository
     * @param  \App\Models\Application $application
     * @return \Illuminate\Http\Response
     */
    public function edit(ApplicationRepository $repository, Application $application)
    {
        $application = $repository->getApplicationWithData($application->id);
//        dump($application, $addictions);
        return view('ap.application.edit', compact('application'));

    }

    public function submit(ChangeStatusRequest $request)
    {
        $application = Application::find($request->id);
        $application->update(['status' => (int)$request->status]);
        $status = ($request->status == 1) ? 'Принята':'Отклонена';
        $status = ($request->status == 0) ? 'Не проверена':$status;
        return response()->json(['success' => "Статус заявки успешно обновлен на '$status'", 'status' => $status, 'updated' => $application->updated_at->toDateTimeString()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateApplicationRequest $request
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateApplicationRequest $request, $id)
    {
        //dd($request, $id);
        $application = Application::find($id);
        if (empty($application)) {
            return back()->withErrors(['msg' => "Запись id= {$id} не найдена"])->withInput();
        }
        $result = $application->update($request->input());

        if ($result) {
            return redirect()
                ->route('application.show', $id)
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
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
