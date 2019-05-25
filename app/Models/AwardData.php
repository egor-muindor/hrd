<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AwardData
 *
 * @property int $id
 * @property string $data
 * @property string $reward
 * @property int $candidate_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AwardData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AwardData newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AwardData query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AwardData whereCandidateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AwardData whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AwardData whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AwardData whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AwardData whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AwardData whereReward($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AwardData whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AwardData extends Model
{
    protected $fillable = [
        'data', 'reward', 'candidate_id',
    ];
}
