<?php

namespace App\Repositories;

use App\Models\Application;
use App\Models\Application as Model;
use App\Models\Departament;
use App\Models\Post;
use Illuminate\Support\Collection;

/**
 * Class RecordRepository
 *
 * @package App\Repositories
 */
class ApplicationRepository extends CoreRepository
{
    /**
     * @return mixed
     */
    protected function getModelClass()
    {
        return Model::class;
    }


    /**
     * Возвращает одну заявку со всеми дополнениями к ней
     *
     * @param $id
     * @return mixed
     */
    public function getApplicationWithData($id)
    {
        if ($this->startConditions()->select(['id'])->find($id) === null) {
            abort(404);
        }
        $columns = [
            'id',
            'first_name',
            'middle_name',
            'last_name',
            'post_id',
            'passport_id',
            'snils',
            'inn',
            'employment_history',
            'scientific_works',
            'email',
            'created_at',
            'updated_at',
            'status'

        ];
        $application = $this->startConditions()->select($columns)->where('id', $id)
            ->with(['post'])
            ->with(['post' => function ($querry) {
                $querry->select(['id', 'name', 'departament_id'])
                    ->with(['departament'])->with(['departament:id,name']);
            }
            ])
            ->get()->First();
        return $application;
    }


    /**
     * Получение списка всех отделов
     *
     * @return array
     */
    public function getDepartamentList()
    {
        $departaments = Departament::select(['id', 'name'])->get();
        //dd($departament);
        return $departaments;
    }

    /**
     * Получение списка всех должностей
     *
     * @return array
     */

    public function getPostsList()
    {
        $indicatorList = Post::select(['id', 'name', 'departament_id'])->get();
        //dd($indicatorList);
        return $indicatorList;
    }

    /**
     * Получение всех доступных должностей по ИД отдела
     * @param $id
     * @return Collection
     *      */
    public function getPostsListByDepartamentId($id)
    {
        $indicatorList = Post::select(['id', 'name', 'departament_id'])->where(['departament_id' => $id])->orderBy('id')->get();
        //dd($indicatorList);
        return $indicatorList;
    }

    public function getAllAddictionsByAppId($id)
    {
        return Application::find($id)->addictions()->get(['description', 'file', 'id']);
    }
}