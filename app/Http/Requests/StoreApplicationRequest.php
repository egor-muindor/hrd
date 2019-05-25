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
            'formData.candidateSurname.required' => 'Поле "Фамилия" обязательно для заполнения.',
            'formData.candidateName.required' => 'Поле "Имя" обязательно для заполнения.',
            'formData.candidatePatronymic.required' => 'Поле "Отчество" обязательно для заполнения.',
            'formData.candidateSex.required' => 'Необходимо выбрать пол.',
            'formData.candidateBirthday.required' => 'Поле "Дата рождения" обязательно для заполнения.',
            'formData.candidateBirthday.date' => 'Поле "Дата рождения" имеет не верный формат.',
            'formData.candidateBirthplace.required' => 'Поле "Место рождения" обязательно для заполнения.',
            'formData.candidateLanguages.required' => 'Поле "Иностранные языки" обязательно для заполнения.',
            'formData.candidateAcademicDegree.required' => 'Поле "Ученая степень" обязательно для заполнения.',
            'formData.candidateScientificWork.required' => 'Поле "Научные труды" обязательно для заполнения.',
            'formData.candidateMilitaryRank.required' => 'Поле "Воинское звание" обязательно для заполнения.',
            'formData.candidateMilitaryComposition.required' => 'Поле "Состав" в разделе "Воиская обязаность" обязательно для заполнения.',
            'formData.candidateMilitaryBranch.required' => 'Поле "Род войск" обязательно для заполнения.',
            'formData.candidateHomeAddress.required' => 'Поле "Домашний адрес" обязательно для заполнения.',
            'formData.candidatePhone.required' => 'Поле "Контактный телефон" обязательно для заполнения.',
            'formData.candidatePhone.regex' => 'Поле "Контактный телефон" имеет не верный формат.',
            'formData.candidatePassportSeries.required' => 'Поле "Серия паспорта" обязательно для заполнения.',
            'formData.candidatePassportSeries.regex' => 'Поле "Серия паспорта" имеет не верный формат.',
            'formData.candidatePassportNumber.required' => 'Поле "Номер паспорта" обязательно для заполнения.',
            'formData.candidatePassportNumber.regex' => 'Поле "Номер паспорта" имеет не верный формат.',
            'formData.candidatePassportGiven.required' => 'Поле "Кем выдан" в разделе "Паспортные данные" обязательно для заполнения.',
            'formData.candidateInn.required' => 'Поле "ИНН" обязательно для заполнения.',
            'formData.candidateInn.regex' => 'Поле "ИНН" имеет не верный формат.',
            'formData.candidatePfr.required' => 'Поле "ПФР" обязательно для заполнения.',
            'formData.candidatePfr.regex' => 'Поле "ПФР" имеет не верный формат.',
            'formData.candidateBiography.required' => 'Поле "Автобиография" обязательно для заполнения.',

            'DataEducation.*.faculty.required' => 'Все поля в таблице "Образование" обязательны для заполнения.',
            'DataEducation.*.formStudy.required' => 'Все поля в таблице "Образование" обязательны для заполнения.',
            'DataEducation.*.admissionYear.required' => 'Все поля в таблице "Образование" обязательны для заполнения.',
            'DataEducation.*.graduationYear.required' => 'Все поля в таблице "Образование" обязательны для заполнения.',
            'DataEducation.*.graduationCourse.required' => 'Все поля в таблице "Образование" обязательны для заполнения.',
            'DataEducation.*.specialty.required' => 'Все поля в таблице "Образование" обязательны для заполнения.',
            'DataEducation.*.diploma.required' => 'Все поля в таблице "Образование" обязательны для заполнения.',

            'DataWork.*.entry.required' => 'Все поля в таблице "Выполняемая работа с начала трудовой деятельности" обязательны для заполнения.',
            'DataWork.*.entry.date' => 'Все поля в таблице "Выполняемая работа с начала трудовой деятельности" должны иметь верный формат.',
            'DataWork.*.exit.required' => 'Все поля в таблице "Выполняемая работа с начала трудовой деятельности" обязательны для заполнения.',
            'DataWork.*.exit.date' => 'Все поля в таблице "Выполняемая работа с начала трудовой деятельности" должны иметь верный формат.',
            'DataWork.*.position.required' => 'Все поля в таблице "Выполняемая работа с начала трудовой деятельности" обязательны для заполнения.',
            'DataWork.*.location.required' => 'Все поля в таблице "Выполняемая работа с начала трудовой деятельности" обязательны для заполнения.',

            'DataAbroad.*.sinceTime.required' => 'Все поля в таблице "Пребывание за границей" должны быть заполнены.',
            'DataAbroad.*.sinceTime.date' => 'Все поля в таблице "Пребывание за границей" должны иметь верный формат.',
            'DataAbroad.*.atTime.required' => 'Все поля в таблице "Пребывание за границей" должны быть заполнены.',
            'DataAbroad.*.atTime.date' => 'Все поля в таблице "Пребывание за границей" должны иметь верный формат.',
            'DataAbroad.*.country.required' => 'Все поля в таблице "Пребывание за границей" должны быть заполнены.',
            'DataAbroad.*.goal.required' => 'Все поля в таблице "Пребывание за границей" должны быть заполнены.',

            'DataAward.*.data.required' => 'Все поля в таблице "Правительственные награды" должны быть заполнены.',
            'DataAward.*.data.date' => 'Все поля в таблице "Правительственные награды" должны иметь верный формат.',
            'DataAward.*.reward.required' => 'Все поля в таблице "Правительственные награды" должны быть заполнены.',

            'DataFamily.*.name.required' => 'Все поля в таблице "Семейное положение" должны быть заполнены.',
            'DataFamily.*.surname.required' => 'Все поля в таблице "Семейное положение" должны быть заполнены.',
            'DataFamily.*.patronymic.required' => 'Все поля в таблице "Семейное положение" должны быть заполнены.',
            'DataFamily.*.birthday.required' => 'Все поля в таблице "Семейное положение" должны быть заполнены.',
            'DataFamily.*.birthday.date' => 'Все поля в таблице "Семейное положение" должны иметь верный формат.',
            'DataFamily.*.telephone.required' => 'Все поля в таблице "Семейное положение" должны быть заполнены.',
            'DataFamily.*.telephone.regex' => 'Все поля в таблице "Семейное положение" должны иметь верный формат.',
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
            'formData.candidateSurname' => 'required',
            'formData.candidateName' => 'required',
            'formData.candidatePatronymic' => 'required',
            'formData.candidateSex' => 'required',
            'formData.candidateBirthday' => 'required|date',
            'formData.candidateBirthplace' => 'required',
            'formData.candidateLanguages' => 'required',
            'formData.candidateAcademicDegree' => 'required',
            'formData.candidateScientificWork' => 'required',
            'formData.candidateMilitaryRank' => 'required',
            'formData.candidateMilitaryComposition' => 'required',
            'formData.candidateMilitaryBranch' => 'required',
            'formData.candidateHomeAddress' => 'required',
            'formData.candidatePhone' => 'required|regex:/^(\+7 \([0-9]{3}\))-[0-9]{3}-[0-9]{2}-[0-9]{2}$/',  # +7 (777)-777-77-77
            'formData.candidatePassportSeries' => 'required|regex:/(^[0-9]{4}$)/',
            'formData.candidatePassportNumber' => 'required|regex:/(^[0-9]{6}$)/',
            'formData.candidatePassportGiven' => 'required',
            'formData.candidateInn' => 'required|regex:/(^[0-9]{12}$)/',
            'formData.candidatePfr' => 'required|regex:/(^[0-9]{3}-[0-9]{3}-[0-9]{3}-[0-9]{2}$)/',
            'formData.candidateBiography' => 'required',

            'DataEducation.*.institution' => 'required',
            'DataEducation.*.faculty' => 'required',
            'DataEducation.*.formStudy' => 'required',
            'DataEducation.*.admissionYear' => 'required',
            'DataEducation.*.graduationYear' => 'required',
            'DataEducation.*.graduationCourse' => 'required',
            'DataEducation.*.specialty' => 'required',
            'DataEducation.*.diploma' => 'required',

            'DataWork.*.entry' => 'required|date',
            'DataWork.*.exit' => 'required|date',
            'DataWork.*.position' => 'required',
            'DataWork.*.location' => 'required',

            'DataAbroad.*.sinceTime' => 'required|date',
            'DataAbroad.*.atTime' => 'required|date',
            'DataAbroad.*.country' => 'required',
            'DataAbroad.*.goal' => 'required',

            'DataAward.*.data' => 'required|date',
            'DataAward.*.reward' => 'required',

            'DataFamily.*.name' => 'required',
            'DataFamily.*.surname' => 'required',
            'DataFamily.*.patronymic' => 'required',
            'DataFamily.*.birthday' => 'required|date',
            'DataFamily.*.telephone' => 'required|regex:/^(\+7 \([0-9]{3}\))-[0-9]{3}-[0-9]{2}-[0-9]{2}$/',
        ];
    }
}


