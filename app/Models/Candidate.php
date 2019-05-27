<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Candidate
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string|null $uncial_id
 * @property string|null $last_visit
 * @property string|null $remember_token
 * @property string $head_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Candidate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Candidate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Candidate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Candidate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Candidate whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Candidate whereHeadName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Candidate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Candidate whereLastVisit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Candidate wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Candidate whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Candidate whereUncialId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Candidate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Candidate extends Model
{
    protected $fillable = [
        'email', 'password', 'uncial_id', 'remember_token', 'last_visit', 'head_name'
    ];
}
