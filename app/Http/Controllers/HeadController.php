<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewUserRequest;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;

class HeadController extends Controller
{
    /**
     * HeadController constructor.
     * Защищает функции ПУ руководителя
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Возвращает главную страницу панели управления руководителя
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $user = Auth::user();
        return view('control_panel.head_index', compact('user'));
    }

    public function createUser(Request $request){
        return view('control_panel.admin.create_user');
    }

    /**
     * Создает нового сотрудника
     *
     * @param StoreNewUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeUser(StoreNewUserRequest $request){
        $data = $request->all(['email', 'name']);
        $data['password'] = Hash::make($request->input('password'));
        $data['email_verified_at'] = Carbon::now();
//        dd($data);
        $user = new User($data);
        $user->save();
        return back()->with(['success' => 'Новый пользователь успешно создан']);
    }

    /**
     * Возвращает список сотрудников
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexUser(){
        $users = User::paginate();

        return view('control_panel.admin.user_list', compact('users'));
    }

    public function resetPassword(Request $request){
        dd(__METHOD__, $request);
    }

    /**
     * Удаляет пользователя
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy(Request $request){
        $user = User::find($request->input('id'));
        if ($user === null){
            return response('Пользователь не найден', $status = '404');
        }
        if ($user->id === Auth::user()->id){
            return response('Нельзя удалить себя', $status = '404');
        }
        $user->forceDelete();
        return response('OK');
    }
}
