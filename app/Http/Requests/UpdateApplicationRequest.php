<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
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


        ];
    }
}
