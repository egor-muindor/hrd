<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Models\Addiction;
use App\Models\Application;
use App\Models\Departaments;



class RegistratorController extends Controller
{

    public function index(){
        $departaments = Departaments::get();
        return view('external.registrator', compact('departaments'));
    }

    public function store(StoreApplicationRequest $request){

        $rawData = $request->input();

        if (!$request->has(['last_name', 'first_name', 'middle_name',
            'passport_id', 'snils', 'inn', 'employment_history', 'email', 'post_id', '_token'])){
            return back()->withErrors(['msg' => 'Ошибка сохранения (#1)'])->withInput();
        }
        if ($request->has('status')){
            return back()->withErrors(['msg' => 'Ошибка сохранения (#2)'])->withInput();
        }

        $data = [
            'first_name' => $rawData['first_name'],
            'middle_name' => $rawData['middle_name'],
            'last_name' => $rawData['last_name'],
            'passport_id' => $rawData['passport_id'],
            'snils' => $rawData['snils'],
            'inn' => $rawData['inn'],
            'employment_history' => $rawData['employment_history'],
            'email' => $rawData['email'],
            'post_id' => $rawData['post_id'],
        ];
        $item = new Application($data);
        $item->save();

        if ($item) {
            if(!empty($request->file('files'))){
                $files = $request->file('files');
                $descriptions = $rawData['description'];
                $count = count($files);
                $app_id = $item->id;
                for ($i = 0; $i < $count; $i++){
                    $file = \Storage::putFile('public/docs', $files[$i]);
                    if ($file) {
                        $addiction_data = [
                            'application_id' => $app_id,
                            'description' => $descriptions[$i],
                            'file' => $file,
                        ];
                        $addiction = new Addiction($addiction_data);
                        $addiction->save();

                        if (!$addiction){
                            return back()->withErrors(['msg' => 'Ошибка сохранения (#5)'])->withInput();
                        }
                    } else {
                        return back()->withErrors(['msg' => 'Ошибка сохранения (#4)'])->withInput();
                    }
                }
            }
            return redirect()->route('registration.index')
                ->with(['success' => 'Ваша заявка отправлнена']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения (#3)'])->withInput();
        }

    }
}