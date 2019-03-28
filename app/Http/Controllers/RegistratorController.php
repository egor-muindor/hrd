<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Mail\AlertHRD;
use App\Models\Addiction;
use App\Models\Application;
use App\Models\Departaments;
use Mail;


class RegistratorController extends Controller
{

    public function index(){
        $departaments = Departaments::get();
        return view('external.registrator', compact('departaments'));
    }

    public function store(StoreApplicationRequest $request){

        $rawData = $request->input();

        if (!$request->has(['last_name', 'first_name', 'middle_name',
            'passport_id', 'snils', 'inn', 'employment_history', 'email',
            'post_id', 'medical_id', 'criminal_record',
            'scientific_works', '_token'])){
            return back()->withErrors(['msg' => 'Ошибка сохранения (#1)'])->withInput();
        }
        if ($request->has('status', 'description')){
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
            'scientific_works' => $rawData['scientific_works'],
            /**
            'medical_id' => $rawData['medical_id'],
            'criminal_record' => $rawData['criminal_record'],
            'military_id' => $rawData['military_id'],
             */
        ];
        $item = new Application($data);
        $item->save();
        $app_id = $item->id;

        $const_files = [
            ['medical_id', 'Медицинская карта'],
            ['criminal_record', 'Справка о наличии (отсутствии) судимости и (или) факта уголовного преследования либо о прекращении уголовного преследования по реабилитирующим основаниям.'],
            ['military_id', 'Документы воинского учета (для военнообязанных и лиц, подлежащих призыву на военную службу).'],
            ['edu_id', 'Документ об образовании, о присвоении ученой степени, о присвоении ученого звания.'],
        ];

        foreach ($const_files as $cf) {
            if(!empty($request->file($cf[0]))) {
                $file = \Storage::putFile('public/docs', $request->file($cf[0]));
                $addiction_data = [
                    'application_id' => $app_id,
                    'description' => $cf[1],
                    'file' => $file,
                ];
                $addiction = new Addiction($addiction_data);
                $addiction->save();
                if (!$addiction) {
                    return back()->withErrors(['msg' => 'Ошибка сохранения (#6)'])->withInput();
                }
            }
        }

        if ($item) {
            if(!empty($request->file('files'))){
                $files = $request->file('files');
                $descriptions = $rawData['description'];
                $count = count($files);

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
            Mail::to('hrd@muindor.com')->queue((new AlertHRD($item))->subject('Новая заявка')->from(['address' => 'robot@muindor.com', 'name' => 'robot']));
            return redirect()->route('registration.index')
                ->with(['success' => 'Ваша заявка отправлнена']);

        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения (#3)'])->withInput();
        }

    }
}