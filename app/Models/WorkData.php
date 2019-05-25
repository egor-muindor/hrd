<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WorkData
 *
 * @property int $id
 * @property string $entry
 * @property string $exit
 * @property string $position
 * @property string $location
 * @property int $candidate_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkData newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkData query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkData whereCandidateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkData whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkData whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkData whereEntry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkData whereExit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkData whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkData whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkData wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkData whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class WorkData extends Model
{
    protected $fillable = [
        'entry', 'exit', 'position', 'location', 'candidate_id'
    ];
}
