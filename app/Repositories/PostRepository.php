<?php

namespace App\Repositories;

use App\Models\Post as Model;

/**
 * Class PostRepository
 *
 * @package App\Repositories
 */
class PostRepository extends CoreRepository
{
    /**
     * Возвращает все записи Post с пагинацией
     * @param int $count
     * @return mixed
     */
    public function getAllWithPaginate($count = 15)
    {
        $columns = [
            'id',
            'name',
            'departament_id',
        ];

        $result = $this->startConditions()->select($columns)
            ->orderBy('id')
            ->with(['departament:id,name'])
            ->paginate($count);

        return $result;
    }

    public function getPostDataByID($id)
    {
        $columns = [
            'id',
            'name',
            'departament_id',
        ];

        $result = $this->startConditions()->select($columns)
            ->whereId($id)
            ->with(['departament:id,name'])->get()->first();

        return $result;
    }

    /**
     * @return mixed
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}