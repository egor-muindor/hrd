<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'last_name', 'first_name', 'middle_name',
        'passport_id', 'snils', 'inn', 'employment_history', 'email', 'post_id'
    ];

    /**
     * Возвращает вакансию
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post(){
        return $this->belongsTo(Posts::class);
    }
}
