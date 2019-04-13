<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartamentRequest;
use App\Models\Departament;
use App\Models\Post;
use Exception;
use Illuminate\Http\Response;

class DepartamentController extends Controller
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
        $departaments = Departament::paginate(15);
        return view('ap.departaments.index', compact('departaments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('ap.departaments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDepartamentRequest $request
     * @return void
     */
    public function store(StoreDepartamentRequest $request)
    {
        $inputs = $request->input();
        $departament_data = [
            'name' => $inputs['name'],
        ];
        $departament = new Departament($departament_data);
        $departament->save();

        if ($departament) {
            return redirect()
                ->route('departament.index')
                ->with(['success' => 'Успешно создано']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Departament $departament
     * @return Response
     */
    public function show(Departament $departament)
    {
        $posts = Post::whereDepartamentId($departament->id)->get();
        return view('ap.departaments.show', compact('departament', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Departament $departament
     * @return Response
     */
    public function edit(Departament $departament)
    {
        return view('ap.departaments.edit', compact('departament'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreDepartamentRequest $request
     * @param Departament $departament
     * @return void
     */
    public function update(StoreDepartamentRequest $request, Departament $departament)
    {
        $inputs = $request->input();
        $departament_data = [
            'name' => $inputs['name'],
        ];
        $status = $departament->update($departament_data);


        if ($status) {
            return redirect()
                ->route('departament.show', $departament->id)
                ->with(['success' => 'Информация об отделе успешно обновлена']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Departament $departament
     * @return void
     * @throws Exception
     */
    public function destroy(Departament $departament)
    {
        $status = $departament->delete();
        if ($status) {
            return redirect()
                ->route('departament.index')
                ->with(['success' => 'Отдел удален']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка удаления'])
                ->withInput();
        }
    }
}
