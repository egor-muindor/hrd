<?php

namespace App\Models;

use Eloquent;
use Iatstuti\Database\Support\CascadeSoftDeletes;
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
 * @property int $archive
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|Departament onlyTrashed()
 * @method static bool|null restore()
 * @method static Builder|Departament whereArchive($value)
 * @method static \Illuminate\Database\Query\Builder|Departament withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Departament withoutTrashed()
 */
class Departament extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
    protected $fillable = ['name'];

    protected $cascadeDeletes = [
        'posts'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
