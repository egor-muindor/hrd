<?php

namespace App\Http\Controllers;


use App\Http\Requests\DeleteAddictionRequest;
use App\Http\Requests\StoreAddictionRequest;
use App\Models\Addiction;
use Debugbar;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class AddictionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Удаляет приложение
     * @param DeleteAddictionRequest $request
     * @return JsonResponse
     */
    public function destroy(DeleteAddictionRequest $request)
    {
        Debugbar::alert($request);
        // return response()->json($request);
        $addiction = Addiction::find($request->addiction_id);
        if ($addiction->application_id == $request->application_id) {
            $file = Storage::delete($addiction->file);
            if ($file) {
                $status = $addiction->forceDelete();
                if ($status) {
                    return response()->json(['message' => 'Успешно удалено', 'code' => 200]);
                } else {
                    return response()->json(['message' => 'Ошибка удаления', 'code' => 500]);
                }
            } else {
                return response()->json(['message' => 'Ошибка удаления', 'code' => 500]);
            }
        } else {
            return response()->json(['message' => 'Ошибка удаления', 'code' => 500]);
        }
    }

    /**
     * Сохраняет новое приложение
     * @param StoreAddictionRequest $request
     * @return JsonResponse
     */
    public function store(StoreAddictionRequest $request)
    {
        Debugbar::info($request);
        $all = $request->all();
        $file = $all['file'];
        $cfile = \Storage::putFile('public/docs', $file);
        if ($cfile) {
            $addiction_data = [
                'application_id' => $request->application_id,
                'description' => $request->description,
                'file' => $cfile,
            ];
            $addiction = new Addiction($addiction_data);
            $addiction->save();
            if (!$addiction) {
                return response()->json(['message' => 'Ошибка сохранения', 'code' => 500]);
            } else {
                return response()->json(['message' => 'Успешно сохранено', 'code' => 200, 'addiction_id' => $addiction->id, 'url' => \Storage::url($addiction->file)]);
            }
        } else {
            return response()->json(['message' => 'Ошибка сохранения', 'code' => 500]);
        }


    }
}
