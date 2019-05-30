<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Addiction
 *
 * @property int $id
 * @property int $application_id
 * @property string $description
 * @property string $file
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Addiction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Addiction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Addiction query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Addiction whereApplicationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Addiction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Addiction whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Addiction whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Addiction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Addiction whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Addiction extends Model
{
    protected $fillable = [
        'application_id', 'description', 'file'
    ];
}
