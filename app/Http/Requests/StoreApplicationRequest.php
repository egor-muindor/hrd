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
            'passport_id' => 'required|min:11|max:11',
            'snils' => 'required|min:2|max:50',
            'inn' => 'required|min:12|max:12',
            'employment_history' => 'required|min:10',
            'email' => 'required|min:5|max:70',
        ];
    }
}

/** 'title' => 'required|min:5|max:200',
 * 'slug' => 'max:200',
 * 'description' => 'string|min:3|max:500',
 * 'parent_id' => 'required|integer|exists:blog_categories,id',
 */
