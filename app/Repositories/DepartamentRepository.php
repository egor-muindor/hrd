<?php

namespace App\Repositories;

use App\Models\Departament as Model;

/**
 * Class DepartamentRepository
 *
 * @package App\Repositories
 */
class DepartamentRepository extends CoreRepository
{
    public function getAllDataByID($id)
    {
        if ($this->startConditions()->select(['id'])->find($id) === null) {
            abort(404);
        }
        $columns = [
            'id',
            'name',
        ];
        $data = $this->startConditions()->select($columns)->whereId($id)->get()->First();

        return $data;
    }

    /**
     * @return mixed
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}