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
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $email
 * @property int $post_id
 * @property int $status
 * @property string $passport_id
 * @property string $employment_history
 * @property string $snils
 * @property string $inn
 * @property string|null $data_token
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read Post $post
 * @method static Builder|Application newModelQuery()
 * @method static Builder|Application newQuery()
 * @method static Builder|Application query()
 * @method static Builder|Application whereCreatedAt($value)
 * @method static Builder|Application whereDataToken($value)
 * @method static Builder|Application whereDeletedAt($value)
 * @method static Builder|Application whereDescription($value)
 * @method static Builder|Application whereEmail($value)
 * @method static Builder|Application whereEmploymentHistory($value)
 * @method static Builder|Application whereFirstName($value)
 * @method static Builder|Application whereId($value)
 * @method static Builder|Application whereInn($value)
 * @method static Builder|Application whereLastName($value)
 * @method static Builder|Application whereMiddleName($value)
 * @method static Builder|Application wherePassportId($value)
 * @method static Builder|Application wherePostId($value)
 * @method static Builder|Application whereSnils($value)
 * @method static Builder|Application whereStatus($value)
 * @method static Builder|Application whereUpdatedAt($value)
 * @mixin Eloquent
 * @property string $scientific_works
 * @property-read Collection|Addiction[] $addictions
 * @method static Builder|Application whereScientificWorks($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|Application onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|Application withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Application withoutTrashed()
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereAcademicDegree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereBiography($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereBirthplace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereHomeAddress($value)
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AbroadData[] $abroad_data
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AwardData[] $award_data
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EducationData[] $education_data
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FamilyData[] $family_data
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WorkData[] $work_data
 */
class Application extends Model
{
    use SoftDeletes, CascadeSoftDeletes;

    protected $fillable = [
        'Surname', 'Name', 'Patronymic', 'Sex', 'Birthday' , 'Birthplace' , 'Languages' , 'AcademicDegree',
        'ScientificWork', 'MilitaryRank', 'MilitaryComposition', 'MilitaryBranch' , 'HomeAddress', 'Phone',
        'PassportSeries', 'PassportNumber', 'PassportGiven', 'Inn' , 'Pfr', 'Biography'
    ];

    protected $cascadeDeletes = [
        'abroad_data', 'award_data', 'education_data', 'family_data', 'work_data'
    ];

    /**
     * Возвращает все записи о кандидате из abroad_data
     *
     * @return HasMany
     */
    public function abroad_data()
    {
        return $this->hasMany(AbroadData::class);
    }

    /**
     * Возвращает все записи о кандидате из award_data
     *
     * @return HasMany
     */
    public function award_data()
    {
        return $this->hasMany(AwardData::class);
    }

    /**
     * Возвращает все записи о кандидате из education_data
     *
     * @return HasMany
     */
    public function education_data()
    {
        return $this->hasMany(EducationData::class);
    }

    /**
     * Возвращает все записи о кандидате из family_data
     *
     * @return HasMany
     */
    public function family_data()
    {
        return $this->hasMany(FamilyData::class);
    }

    /**
     * Возвращает все записи о кандидате из work_data
     *
     * @return HasMany
     */
    public function work_data()
    {
        return $this->hasMany(WorkData::class);
    }
}
