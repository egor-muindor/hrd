<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Models\Application;
use App\Models\Departaments;
use App\Models\Posts;
use Illuminate\Http\Request;

class RegistratorController extends Controller
{

    public function index(){
        $departaments = Departaments::get();
        $posts = Posts::get();

        return view('external.registrator', compact('departaments', 'posts'));
    }

    public function store(StoreApplicationRequest $request){
//        dd(__METHOD__, $request);

        $rawData = $request->input();
        //dd($data);
        if (!$request->has(['last_name', 'first_name', 'middle_name',
            'passport_id', 'snils', 'inn', 'employment_history', 'email', 'post_id', '_token'])){
            return back()->withErrors(['msg' => 'Ошибка сохранения (#1)'])->withInput();
        }
        if ($request->has('status')){
            return back()->withErrors(['msg' => 'Ошибка сохранения (#2)'])->withInput();
        }
//        dd($rawData['first_name']);

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
            return redirect()->route('registration.index')
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения (#3)'])->withInput();
        }

        //dd($request);


    }
}