<?php

namespace App\Http\Controllers;

use App\Repositories\ApplicationRepository;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function postsList(Request $request, ApplicationRepository $repository){

        if($request->has('departament_id')) {
            $postList = $repository->getPostsListByDepartamentId($request['departament_id']);
            return response()->json(compact('postList'));
        } else {
            return response()->json('No valid data');
        }
    }
}
