<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EducationData
 *
 * @property int $id
 * @property string $institution
 * @property string $faculty
 * @property string $formStudy
 * @property string $admissionYear
 * @property string $graduationYear
 * @property string $graduationCourse
 * @property string $specialty
 * @property string $diploma
 * @property int $candidate_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationData newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationData query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationData whereAdmissionYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationData whereCandidateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationData whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationData whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationData whereDiploma($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationData whereFaculty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationData whereFormStudy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationData whereGraduationCourse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationData whereGraduationYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationData whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationData whereInstitution($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationData whereSpecialty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationData whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EducationData extends Model
{
    protected $fillable = [
        'institution' , 'faculty', 'formStudy' , 'admissionYear' , 'graduationYear' ,
        'graduationCourse' , 'specialty' , 'diploma' , 'candidate_id'
    ];
}
