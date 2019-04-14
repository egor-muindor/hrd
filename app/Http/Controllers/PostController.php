<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Departament;
use App\Models\Post;
use App\Repositories\PostRepository;
use Exception;
use Illuminate\Http\Response;

class PostController extends Controller
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
    public function index(PostRepository $repository)
    {
        $posts = $repository->getAllWithPaginate(15);
        return view('ap.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $departaments = Departament::get();

        return view('ap.posts.create', compact('departaments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePostRequest $request
     * @return void
     */
    public function store(StorePostRequest $request)
    {
        $inputs = $request->input();
        $post_data = [
            'name' => $inputs['name'],
            'departament_id' => $inputs['departament_id']
        ];
        $post = new Post($post_data);
        $post->save();

        if ($post) {
            return redirect()
                ->route('post.index')
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
     * @param Post $post
     * @return void
     */
    public function show(Post $post)
    {
        return view('ap.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return Response
     */
    public function edit(Post $post)
    {
        $departaments = Departament::get();
        return view('ap.posts.edit', compact('post', 'departaments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StorePostRequest $request
     * @param Post $post
     * @return Response
     */
    public function update(StorePostRequest $request, Post $post)
    {
        $inputs = $request->input();
        $post_data = [
            'name' => $inputs['name'],
            'departament_id' => $inputs['departament_id']
        ];
        $status = $post->update($post_data);


        if ($status) {
            return redirect()
                ->route('post.show', $post->id)
                ->with(['success' => 'Информация о вакансии успешно обновлена']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return Response
     * @throws Exception
     */
    public function destroy(Post $post)
    {
        $status = $post->delete();
        if ($status) {
            return redirect()
                ->route('post.index')
                ->with(['success' => 'Вакансия удалена']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка удаления'])
                ->withInput();
        }
    }
}
