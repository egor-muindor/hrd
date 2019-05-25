<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AbortData
 *
 * @property int $id
 * @property string $sinceTime
 * @property string $atTime
 * @property string $country
 * @property string $goal
 * @property int $candidate_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AbortData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AbortData newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AbortData query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AbortData whereAtTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AbortData whereCandidateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AbortData whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AbortData whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AbortData whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AbortData whereGoal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AbortData whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AbortData whereSinceTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AbortData whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AbroadData extends Model
{
    protected $fillable = [
        'sinceTime', 'atTime', 'country', 'goal', 'candidate_id',
    ];
}
