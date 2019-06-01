<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Invite
 *
 * @property int $id
 * @property string $email
 * @property string $token
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $head_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite whereHeadName($value)
 */
class Invite extends Model
{
    protected $fillable = [
        'email', 'token', 'status', 'head_name'
    ];
}
