<?php

namespace App\Repositories;

use App\Models\Application as Model;
use App\Models\Departaments;
use App\Models\Posts;
use Illuminate\Pagination\LengthAwarePaginator;

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
     * Получение всех записей для вывода в списке
     *
     * @param $count count pages for paginate
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate($count)
    {
        $columns = [
            'id',
            'professor_id',
            'indicator_id',
            'audit_status',
            'start',
            'end',
        ];

        $result = $this->startConditions()->select($columns)
            ->orderBy('id')->with(['indicator','professor'])
            ->with(['indicator' => function ($querry)
            {
                $querry->select(['id','name','sub_activity_id'])
                    ->with(['sub_activity'])->with(['sub_activity:id,name']);
            }
            ,'professor:id,first_name,middle_name,last_name'])
            ->paginate($count);
            //->get();

        //dd($result);
        return $result;
    }

    /**
     * Возвращает одну запись со всеми дополнениями к ней
     *
     * @param $id
     * @return array
     */
    public function getRecordWithAddiction($id)
    {
        if ($this->startConditions()->select(['id'])->find($id) === null){
            abort(404, 'getRecordWithAddiction exception');
        }
        $columns = [
            'id',
            'professor_id',
            'indicator_id',
            'audit_status',
            'start',
            'end',
            'created_at',
            'updated_at',
        ];
        $record = $this->startConditions()->select($columns)->where('id', $id)
            ->with(['indicator','professor'])
            ->with(['indicator' => function ($querry)
            {
                $querry->select(['id','name','sub_activity_id'])
                    ->with(['sub_activity'])->with(['sub_activity:id,name']);
            }
                ,'professor:id,first_name,middle_name,last_name'])
            ->get()->First();

        $addictions = $this->startConditions()->find($id)->addictions()->select('id','name','value')->get();

        return compact('record', 'addictions');
    }


    /**
     * Получение списка всех отделов
     *
     * @return array
     */
    public function getSubActivityList()
    {
        $departaments = Departaments::select(['id','name'])->get();
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
        $indicatorList = Posts::select(['id','name','departament_id'])->get();
        //dd($indicatorList);
        return $indicatorList;
    }

    public function getPostsListByDepartamentId($id)
    {
        $indicatorList = Posts::select(['id','name','departament_id'])->where(['departament_id' => $id])->orderBy('id')->get();
        //dd($indicatorList);
        return $indicatorList;
    }


}