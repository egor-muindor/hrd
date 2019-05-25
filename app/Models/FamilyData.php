<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FamilyData
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property string $birthday
 * @property string $telephone
 * @property int $candidate_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FamilyData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FamilyData newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FamilyData query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FamilyData whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FamilyData whereCandidateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FamilyData whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FamilyData whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FamilyData whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FamilyData whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FamilyData wherePatronymic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FamilyData whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FamilyData whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FamilyData whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FamilyData extends Model
{
    protected $fillable = [
        'name', 'surname', 'patronymic', 'birthday', 'telephone', 'candidate_id',
    ];
}
