<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // отключает требование авторизации
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'passport_id.required' => 'Необходимо ввести серию и номер паспорта.',
            'passport_id.regex' => 'Необходимо ввести серию и номер паспорта согласно маске, например 1234 123456.',
            'snils.required' => 'Необходимо ввести СНИЛС.',
            'snils.regex' => 'Необходимо ввести СНИЛС согласно маске, например 123-456-789-12.',
            'inn.required' => 'Необходимо ввести ИНН.',
            'inn.regex' => 'Необходимо ввести ИНН согласно маске, например 123456789012.',
            'employment_history.required' => 'Поле "Трудовая история" должно быть не менее :min.',
            'check1.accepted' => 'Вы должны принять условия соглашения.',
            'post_id.required' => 'Необходимо выбрать должность.',
            'scientific_works' => 'Поле "Научные труды" должно быть не менее :min.',
            'email.required' => 'В поле "Email" должен быть действительный электронный адрес.',
            'email.email' => 'В поле "Email" должен быть действительный электронный адрес.',
            'criminal_record.required' => 'Необходимо загрузить справку о наличии (отсутствии) судимости.',
            'medical_id.required' => 'Необходимо загрузить медицинскую книжку',
            'edu_id.required' => 'Необходимо загрузить документ об образовании, о присвоении ученой степени, о присвоении ученого звания.',
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|min:2|max:50',
            'middle_name' => 'required|min:2|max:50',
            'last_name' => 'required|min:2|max:50',
            'passport_id' => 'required|regex:/(^[0-9]{4} [0-9]{6}$)/',
            'snils' => 'required|regex:/(^[0-9]{3}-[0-9]{3}-[0-9]{3}-[0-9]{2}$)/',
            'inn' => 'required|regex:/(^[0-9]{12}$)/',
            'employment_history' => 'required|min:10',
            'scientific_works' => 'required|min:10',
            'email' => 'required|email|min:5|max:70',
            'post_id' => 'required|exists:posts,id',
            'check1' => 'accepted',

            'files' => 'array',
            'description' => 'array',

            'military_id' => 'array',
            'criminal_record' => 'required|array',
            'medical_id' => 'required|array',
            'edu_id' => 'required|array',
        ];
    }
}

/** 'title' => 'required|min:5|max:200',
 * 'slug' => 'max:200',
 * 'description' => 'string|min:3|max:500',
 * 'parent_id' => 'required|integer|exists:blog_categories,id',
 */
