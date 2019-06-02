<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\StoreCandidateRequest;
use App\Jobs\ExportTo1C;
use App\Jobs\RefreshStatusJob;
use App\Models\AbroadData;
use App\Models\Addiction;
use App\Models\Application;
use App\Models\AwardData;
use App\Models\Candidate;
use App\Models\EducationData;
use App\Models\FamilyData;
use App\Models\Invite;
use App\Models\WorkData;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Storage;


class RegistratorController extends Controller
{
    /**
     * Возвращает страницу авторизации соискателя
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function auth()
    {
        return view('external.auth_candidate');
    }

    /**
     * Разлогинивает соискателя
     *
     * @param Request $request
     * @return RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        return redirect('/')->cookie('candidate_token', '', 0);
    }

    /**
     * Функция авторизации кандидата
     *
     * @param Request $request
     * @return RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function authorization(Request $request)
    {
        $candidate = Candidate::whereEmail($request->email)->first();
        if (!empty($candidate)) {
            $hash = Hash::check($request->input('password'), $candidate->password);
            if ($hash) {
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

    /**
     * Обработка инвайт ссылки для регистрации соискателя
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function registrationCandidate(Request $request)
    {
        $invite = Invite::whereToken($request->input('token'))->get()
            ->firstWhere('email', '=', $request->input('email'));
        if ($invite === null) {
            return view('external.register_timeout');
        }
        return view('external.register', compact('invite'));
    }

    /**
     * Функция создания учетной записи соискателя
     *
     * @param StoreCandidateRequest $request
     * @return RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(StoreCandidateRequest $request)
    {
        $invite = Invite::whereToken($request->input('token'))->get()
            ->firstWhere('email', '=', $request->input('email'));
        if ($invite === null) {
            return back()->withInput()->withErrors('Ошибка регистрации');
        }
        $data = [
            'email' => $invite->email,
            'password' => \Hash::make($request->input('password')),
            'head_name' => $invite->head_name,
            'status' => 'Не отправлено'
        ];

        $newCandidate = new Candidate($data);
        $result = $newCandidate->save();
        if ($result) {
            $invite->forceDelete();
            return redirect(route('registration.auth'));
        }

        return back()->withInput()->withErrors('Ошибка сохранения');
    }

    /**
     * Возвращает главную страницу сайта
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('external.main_page');
    }

    /**
     * Возвращает главную страницу личного кабинета соискателя
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function lk_candidate(Request $request)
    {
        $candidate = Candidate::whereRememberToken($request->cookie('candidate_token'))->first();
        if ($candidate->status === 'Направлено в отдел кадров' or $candidate->status === 'На рассмотрении') {
//            dd($candidate);
            RefreshStatusJob::dispatch($candidate);
        }
        if ($request->input('success') === "1") {
            return view('external.lk_candidate')->with(['success' => 'Заявка упешно отправлена', 'candidate' => $candidate]);
        }
        return view('external.lk_candidate', compact('candidate'));
    }

    /**
     * Возвращает окно заявки, если она ещё не подана
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $candidate = Candidate::whereRememberToken($request->cookie('candidate_token'))->first();
        if ($candidate->status === 'Не отправлено') {
            return view('external.newRegistrator');
        }
        return redirect(route('registration.lk'))->withErrors(['message' => 'Заявление уже отправлено в отдел кадров']);
    }

    /**
     * Функция обработки заявки от соискателя
     *
     * @param StoreApplicationRequest $request
     * @return RedirectResponse
     */
    public function store(StoreApplicationRequest $request)
    {
        $token = Candidate::whereRememberToken($request->cookie('candidate_token'))->first();
        if (empty($request->cookie('candidate_token'))) {
            return response()->json(['message' => 'Ошибка авторизации', 'code' => 500]);
        } else if (empty($token)) {
            return response()->json(['message' => 'Ошибка авторизации', 'code' => 500]);
        } else if ($token->status !== 'Не отправлено') {
            return response()->json(['message' => 'Заявление уже существует', 'code' => 500]);
        }
        $rawData = $request->input();

        if (!empty($request->file('avatar'))) {
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
            'avatar' => $avatar,
        ]);
        $candidate->save();
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
        if (!empty($request->all(['files'])['files'])) {
            $files = $request->all(['files'])['files'];
            $titles = $request->input('title');
            $count = count($files);
            for ($i = 0; $i < $count; $i++) {
                $file = Storage::putFile('public/docs', $files[$i]);
                if ($file) {
                    $addiction_data = [
                        'application_id' => $id,
                        'description' => $titles[$i],
                        'file' => $file,
                    ];
                    $addiction = new Addiction($addiction_data);
                    $addiction->save();
                    if (!$addiction) {
                        return back()->withErrors(['msg' => 'Ошибка сохранения (#5)'])->withInput();
                    }
                } else {
                    return back()->withErrors(['msg' => 'Ошибка сохранения (#4)'])->withInput();
                }
            }
        }
        $candidate->candidate()->update(['status' => 'Направлено в отдел кадров']);
        try {
            ExportTo1C::dispatch($candidate);
        } catch (Exception $error) {
            return response()->json(['message' => 'Ошибка отправки в 1С', 'code' => 500]);
        }
        return response()->json(['message' => 'Данные отправлены', 'code' => 200]);
    }
}