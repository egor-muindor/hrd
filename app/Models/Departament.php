<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Departament
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|Departament newModelQuery()
 * @method static Builder|Departament newQuery()
 * @method static Builder|Departament query()
 * @method static Builder|Departament whereCreatedAt($value)
 * @method static Builder|Departament whereDeletedAt($value)
 * @method static Builder|Departament whereId($value)
 * @method static Builder|Departament whereName($value)
 * @method static Builder|Departament whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Departament extends Model
{
    use SoftDeletes;
    protected $fillable = ['name'];
}
