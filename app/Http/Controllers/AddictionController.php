<?php

namespace App\Http\Controllers;


use App\Http\Requests\DeleteAddictionRequest;
use App\Models\Addiction;
use Illuminate\Http\Request;

class AddictionController extends Controller
{
    public function destroy(DeleteAddictionRequest $request)
    {
        // return response()->json($request);
        $addiction = Addiction::find($request->addiction_id);
        if ($addiction->application_id == $request->application_id){
        $status = $addiction->delete();
        if ($status){
            return  response()->json(['message' => 'Успешно удалено', 'code' => 200]);
        } else {
            return response()->json(['message' => 'Ошибка удаления', 'code' => 500]);
        }
        } else {
            return response()->json(['message' => 'Ошибка удаления', 'code' => 500]);
        }
    }
}
