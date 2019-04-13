<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeStatusRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Models\Application;
use App\Models\Departament;
use App\Models\Post;
use App\Repositories\ApplicationRepository;
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
                ->route('application.show', $id)
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
        $application = Application::findOrFail($request->id);
        try {
            $client = new SoapClient(env('ADDRESS_1C', 'disable.1c')); //для 1с
            $status = 'Ошибка определения статуса';
            switch ($application->status) {
                case 0:
                    $status = 'Не проверена';
                    break;
                case 1:
                    $status = 'Принята';
                    break;
                case 2:
                    $status = 'Отклонена';
                    break;
            }
            $data = array(
                'first_name' => $application->first_name,
                'middle_name' => $application->middle_name,
                'last_name' => $application->last_name,
                'post_id' => $application->post->name,
                'passport_id' => $application->passport_id,
                'employment_history' => $application->employment_history,
                'snils' => $application->snils,
                'inn' => $application->inn,
                'scientific_works' => $application->scientific_works,
                'email' => $application->email,
                'status' => $status,
                'description' => $application->description);

            $result = $client->SendApplication($data);
            return response()->json(['message' => 'Успешно отправлено в БД 1С', 'code' => $result->return]);
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
            return back()
                ->withErrors(['msg' => 'Ошибка удаления'])
                ->withInput();
        }
    }
}
