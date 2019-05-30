<?php

namespace App\Models;

use Eloquent;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;


/**
 * App\Models\Application
 *
 * @property int $id
 * @property int $candidate_id
 * @property string $Surname
 * @property string $Name
 * @property string $Patronymic
 * @property string $Sex
 * @property string $Birthday
 * @property string $Birthplace
 * @property string $Languages
 * @property string $AcademicDegree
 * @property string $ScientificWork
 * @property string $MilitaryRank
 * @property string $MilitaryComposition
 * @property string $MilitaryBranch
 * @property string $HomeAddress
 * @property string $Phone
 * @property string $PassportSeries
 * @property string $PassportNumber
 * @property string $PassportGiven
 * @property string $Inn
 * @property string $Pfr
 * @property string $Biography
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AbroadData[] $abroad_data
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AwardData[] $award_data
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EducationData[] $education_data
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FamilyData[] $family_data
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WorkData[] $work_data
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Application onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereAcademicDegree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereBiography($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereBirthplace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereCandidateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereHomeAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereInn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereLanguages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereMilitaryBranch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereMilitaryComposition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereMilitaryRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application wherePassportGiven($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application wherePassportNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application wherePassportSeries($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application wherePatronymic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application wherePfr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereScientificWork($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Application withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Application withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Addiction[] $addictions
 */
class Application extends Model
{
    use SoftDeletes, CascadeSoftDeletes;

    protected $fillable = [
        'Surname', 'Name', 'Patronymic', 'Sex', 'Birthday' , 'Birthplace' , 'Languages' , 'AcademicDegree',
        'ScientificWork', 'MilitaryRank', 'MilitaryComposition', 'MilitaryBranch' , 'HomeAddress', 'Phone',
        'PassportSeries', 'PassportNumber', 'PassportGiven', 'Inn' , 'Pfr', 'Biography', 'candidate_id', 'avatar'
    ];

    protected $cascadeDeletes = [
        'abroad_data', 'award_data', 'education_data', 'family_data', 'work_data'
    ];

    /**
     * Возвращает все приложенные файлы
     *
     * @return HasMany
     */
    public function addictions(){
        return $this->hasMany(Addiction::class);
    }

    /**
     * Возвращает все записи о кандидате из abroad_data
     *
     * @return HasMany
     */
    public function abroad_data()
    {
        return $this->hasMany(AbroadData::class,'candidate_id');
    }

    /**
     * Возвращает все записи о кандидате из award_data
     *
     * @return HasMany
     */
    public function award_data()
    {
        return $this->hasMany(AwardData::class,'candidate_id');
    }

    /**
     * Возвращает все записи о кандидате из education_data
     *
     * @return HasMany
     */
    public function education_data()
    {
        return $this->hasMany(EducationData::class,'candidate_id');
    }

    /**
     * Возвращает все записи о кандидате из family_data
     *
     * @return HasMany
     */
    public function family_data()
    {
        return $this->hasMany(FamilyData::class,'candidate_id');
    }

    /**
     * Возвращает все записи о кандидате из work_data
     *
     * @return HasMany
     */
    public function work_data()
    {
        return $this->hasMany(WorkData::class,'candidate_id');
    }
}
