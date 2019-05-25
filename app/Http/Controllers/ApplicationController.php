<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeStatusRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Jobs\ExportTo1C;
use App\Models\Application;
use App\Models\Departament;
use App\Models\Post;
use App\Repositories\ApplicationRepository;
use Carbon\Carbon;
use Debugbar;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SoapClient;

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $paginator = Application::orderBy('id', 'desc')->paginate(15);
        return view('ap.application.index', compact('paginator'));
    }


    public function unchecked()
    {
        $paginator = Application::whereStatus(0)->orderBy('id', 'desc')->paginate(15);
        return view('ap.application.index', compact('paginator'));
    }

    /**
     * Display the specified resource.
     *
     * @param Application $application
     * @param ApplicationRepository $repository
     * @return Response
     */
    public function show(Application $application, ApplicationRepository $repository)
    {
        $addictions = $repository->getAllAddictionsByAppId($application->id);
        $application = $repository->getApplicationWithData($application->id);
//        dump($application, $addictions);
        return view('ap.application.show', compact('application', 'addictions'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ApplicationRepository $repository
     * @param Application $application
     * @return Response
     */
    public function edit(ApplicationRepository $repository, Application $application)
    {
        $application = $repository->getApplicationWithData($application->id);
        $departaments = Departament::get();
        $addictions = $repository->getAllAddictionsByAppId($application->id);
        $posts = Post::whereDepartamentId($application->post->departament_id)->get();
        return view('ap.application.edit', compact('application', 'departaments', 'posts', 'addictions'));

    }

    public function submit(ChangeStatusRequest $request)
    {
        $application = Application::find($request->id);
        $application->update(['status' => (int)$request->status]);
        $status = ($request->status == 1) ? 'Принята' : 'Отклонена';
        $status = ($request->status == 0) ? 'Не проверена' : $status;
        return response()->json(['success' => "Статус заявки успешно обновлен на '$status'", 'status' => $status, 'updated' => $application->updated_at->toDateTimeString()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateApplicationRequest $request
     * @param Application $application
     * @return RedirectResponse
     */
    public function update(UpdateApplicationRequest $request, Application $application)
    {
        if ($application === null) {
            return back()->withErrors(['msg' => "Запись не найдена"])->withInput();
        }
        $result = $application->update($request->input());

        if ($result) {
            return redirect()
                ->route('application.show', $application->id)
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function export(Request $request)
    {
        try {
            $item = Application::findOrFail($request->id);
            ExportTo1C::dispatch($item)->delay(Carbon::now()->addSeconds(15));
            return response()->json(['message' => 'Успешно отправлено в БД 1С', 'code' => 200]);
        } catch (Exception $error) {
            Debugbar::info($error);
            return response()->json(['message' => 'Ошибка сохранения в 1С', 'code' => 500]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Application $application
     * @return Response
     * @throws Exception
     */
    public function destroy(Application $application)
    {
        $status = $application->delete();
        if ($status) {
            return redirect()
                ->route('application.index')
                ->with(['success' => "Заявка №$application->id успешно удалена"]);
        } else {
            return redirect()->route('application.index')
                ->withErrors(['msg' => 'Ошибка удаления']);
        }
    }
}
