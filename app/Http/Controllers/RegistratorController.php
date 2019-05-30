<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Jobs\ExportTo1C;
use App\Models\AbroadData;
use App\Models\Addiction;
use App\Models\Application;
use App\Models\AwardData;
use App\Models\Candidate;
use App\Models\EducationData;
use App\Models\FamilyData;
use App\Models\WorkData;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Storage;


class RegistratorController extends Controller
{
    public function auth(){
        return view('external.auth_candidate');
    }

    /**
     * @param Request $request
     */
    public function authorization(Request $request)
    {
        $candidate = Candidate::whereEmail($request->email)->first();
        if (!empty($candidate)) {
            $hash = Hash::check($request->input('password'),$candidate->password);
            if ($hash){
                $token = Hash::make(Str::random());
                $candidate->update(['remember_token' => $token]);
                return redirect(route('registration.create'))->cookie('candidate_token', $token);
            } else {
                return back()->withInput()->withErrors('Неверная почта или пароль');
            }
        } else {
            return back()->withInput()->withErrors('Неверная почта или пароль');
        }


    }

    public function index()
    {
        return view('external.main_page');
    }

    /**
     * Возвращает окно заявки
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        if (empty($request->cookie('candidate_token'))){
            return redirect(route('registration.auth'));
        } else if(empty(Candidate::whereRememberToken($request->cookie('candidate_token'))->first())){
            return redirect(route('registration.auth'));
        }
        return view('external.newRegistrator');
    }

    /**
     * Отправляет новую заявку в 1С
     *
     * @param StoreApplicationRequest $request
     * @return RedirectResponse
     */
    public function store(StoreApplicationRequest $request)
    {
//        dd(__METHOD__, $request->input());
        $token = Candidate::whereRememberToken($request->cookie('candidate_token'))->first();
        if (empty($request->cookie('candidate_token'))){
            return response()->json(['message' => 'Ошибка авторизации', 'code' => 500]);
        } else if(empty($token)){
            return response()->json(['message' => 'Ошибка авторизации', 'code' => 500]);
        }
        $rawData = $request->input();

        if(!empty($request->file('avatar'))){
            $avatar = Storage::putFile('public/docs', $request->file('avatar'));
        } else {
            $avatar = null;
        }

        $candidate = new Application([
            'candidate_id' => $token->id,
            'Surname' => $rawData['formData']['candidateSurname'],
            'Name' => $rawData['formData']['candidateName'],
            'Patronymic' => $rawData['formData']['candidatePatronymic'],
            'Sex' => $rawData['formData']['candidateSex'],
            'Birthday' => $rawData['formData']['candidateBirthday'],
            'Birthplace' => $rawData['formData']['candidateBirthplace'],
            'Languages' => $rawData['formData']['candidateLanguages'],
            'AcademicDegree' => $rawData['formData']['candidateAcademicDegree'],
            'ScientificWork' => $rawData['formData']['candidateScientificWork'],
            'MilitaryRank' => $rawData['formData']['candidateMilitaryRank'],
            'MilitaryComposition' => $rawData['formData']['candidateMilitaryComposition'],
            'MilitaryBranch' => $rawData['formData']['candidateMilitaryBranch'],
            'HomeAddress' => $rawData['formData']['candidateHomeAddress'],
            'Phone' => $rawData['formData']['candidatePhone'],
            'PassportSeries' => $rawData['formData']['candidatePassportSeries'],
            'PassportNumber' => $rawData['formData']['candidatePassportNumber'],
            'PassportGiven' => $rawData['formData']['candidatePassportGiven'],
            'Inn' => $rawData['formData']['candidateInn'],
            'Pfr' => $rawData['formData']['candidatePfr'],
            'Biography' => $rawData['formData']['candidateBiography'],
            'avatar' => $avatar
        ]);
        $candidate->save();
        dd($candidate->avatar);
        $id = $candidate->id;
        foreach ($rawData['DataEducation'] as $data) {
            $educationData = new EducationData([
                'institution' => $data['institution'],
                'faculty' => $data['faculty'],
                'formStudy' => $data['formStudy'],
                'admissionYear' => $data['admissionYear'],
                'graduationYear' => $data['graduationYear'],
                'graduationCourse' => $data['graduationCourse'],
                'specialty' => $data['specialty'],
                'diploma' => $data['diploma'],
                'candidate_id' => $id
            ]);
            $educationData->save();
        }
        foreach ($rawData['DataWork'] as $data) {
            $workData = new WorkData([
                'entry' => $data['entry'],
                'exit' => $data['exit'],
                'position' => $data['position'],
                'location' => $data['location'],
                'candidate_id' => $id
            ]);
            $workData->save();
        }
        foreach ($rawData['DataAbroad'] as $data) {
            $aboardData = new AbroadData([
                'sinceTime' => $data['sinceTime'],
                'atTime' => $data['atTime'],
                'country' => $data['country'],
                'goal' => $data['goal'],
                'candidate_id' => $id
            ]);
            $aboardData->save();
        }
        foreach ($rawData['DataAward'] as $data) {
            $awardData = new AwardData([
                'data' => $data['data'],
                'reward' => $data['reward'],
                'candidate_id' => $id
            ]);
            $awardData->save();
        }
        foreach ($rawData['DataFamily'] as $data) {
            $familyData = new FamilyData([
                'name' => $data['name'],
                'surname' => $data['surname'],
                'patronymic' => $data['patronymic'],
                'birthday' => $data['birthday'],
                'telephone' => $data['telephone'],
                'candidate_id' => $id
            ]);
            $familyData->save();
        }

//        dd(__METHOD__);
        if(!empty($request->all(['files'])['files'])){
            $files = $request->all(['files'])['files'];
            $titles = $request->input('title');
            $count = count($files);
            for ($i = 0; $i < $count; $i++){
                $file = Storage::putFile('public/docs', $files[$i]);
                if ($file) {
                    $addiction_data = [
                        'application_id' => $id,
                        'description' => $titles[$i],
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
//            dd(__METHOD__, $candidate->addictions()->get());
        }
        try {
            ExportTo1C::dispatch($candidate);
        } catch (Exception $error) {
            return response()->json(['message' => 'Ошибка отправки в 1С', 'code' => 500]);
        }
        return response()->json(['message' => 'Данные отправлены', 'code' => 200]);
    }
}