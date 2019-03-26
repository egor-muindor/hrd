<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Posts $post
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereDataToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereEmploymentHistory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereInn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application wherePassportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereSnils($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Application extends Model
{
    protected $fillable = [
        'last_name', 'first_name', 'middle_name',
        'passport_id', 'snils', 'inn', 'employment_history', 'email', 'post_id', 'data_token'
    ];

    /**
     * Возвращает вакансию
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post(){
        return $this->belongsTo(Posts::class);
    }
}
