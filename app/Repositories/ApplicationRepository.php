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

}