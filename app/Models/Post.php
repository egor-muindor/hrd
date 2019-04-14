<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property string $name
 * @property int $departament_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|Post newModelQuery()
 * @method static Builder|Post newQuery()
 * @method static Builder|Post query()
 * @method static Builder|Post whereCreatedAt($value)
 * @method static Builder|Post whereDeletedAt($value)
 * @method static Builder|Post whereDepartamentId($value)
 * @method static Builder|Post whereId($value)
 * @method static Builder|Post whereName($value)
 * @method static Builder|Post whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read Departament $departament
 * @property int $archive
 * @method static Builder|Post whereArchive($value)
 */
class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'departament_id'
    ];


    public function departament()
    {
        return $this->belongsTo(Departament::class);
    }
}
