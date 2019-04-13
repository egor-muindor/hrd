<?php

namespace App\Models;

use Eloquent;
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
 */
class Application extends Model

{
    use SoftDeletes;
    protected $fillable = [
        'last_name', 'first_name', 'middle_name',
        'passport_id', 'snils', 'inn', 'employment_history', 'email',
        'post_id', 'scientific_works', 'status', 'deleted_at'
    ];

    /**
     * Возвращает вакансию
     *
     * @return BelongsTo
     */
    public function post(){
        return $this->belongsTo(Post::class);
    }

    /**
     * Возвращает все приложенные файлы
     *
     * @return HasMany
     */
    public function addictions(){
        return $this->hasMany(Addiction::class);
    }
}
