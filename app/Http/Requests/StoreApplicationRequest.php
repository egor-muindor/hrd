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
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'formData.candidateSurname' => 'Фамилия',
            'formData.candidateName' => 'Имя',
            'formData.candidatePatronymic' => 'Отчество',
            'formData.candidateSex' => 'Пол',
            'formData.candidateBirthday' => 'Дата рождения',
            'formData.candidateBirthplace' => 'Место рождения',
            'formData.candidateLanguages' => 'Иностранные языки',
            'formData.candidateAcademicDegree' => 'Учёная степеть',
            'formData.candidateScientificWork' => 'Научные труды',
            'formData.candidateMilitaryRank' => 'Звание',
            'formData.candidateMilitaryComposition' => 'Состав',
            'formData.candidateMilitaryBranch' => 'Род войск',
            'formData.candidateHomeAddress' => 'Домашний адрес',
            'formData.candidatePhone' => 'Номер телефона',  # +7 (777)-777-77-77
            'formData.candidatePassportSeries' => 'Серия паспорта',
            'formData.candidatePassportNumber' => 'Номер паспорта',
            'formData.candidatePassportGiven' => 'Кем выдан паспорт',
            'formData.candidateInn' => 'ИНН',
            'formData.candidatePfr' => 'СНИЛС',
            'formData.candidateBiography' => 'Автобиография',

            'DataEducation.*.institution' => 'Образование: Институт',
            'DataEducation.*.faculty' => 'Образование: Факультет',
            'DataEducation.*.formStudy' => 'Образование: Форма обучения',
            'DataEducation.*.admissionYear' => 'Образование: Год начала обучения',
            'DataEducation.*.graduationYear' => 'Образование: Год окончания обучения',
            'DataEducation.*.graduationCourse' => 'Образование: Курс окончания',
            'DataEducation.*.specialty' => 'Образование: Специальность',
            'DataEducation.*.diploma' => 'Образование: Номер диплома',

            'DataWork.*.entry' => 'Работа: Дата поступления',
            'DataWork.*.exit' => 'Работа: Дата ухода',
            'DataWork.*.position' => 'Работа: Должность',
            'DataWork.*.location' => 'Работа: Местонахождение',

            'DataAbroad.*.sinceTime' => 'Пребывание за границей: С какого времени',
            'DataAbroad.*.atTime' => 'Пребывание за границей: До какого времени',
            'DataAbroad.*.country' => 'Пребывание за границей: В какой стране',
            'DataAbroad.*.goal' => 'Пребывание за границей: Цель прибывания',

            'DataAward.*.data' => 'Награды: Дата',
            'DataAward.*.reward' => 'Награды: Название награды',

            'DataFamily.*.name' => 'Семейное положение: Имя',
            'DataFamily.*.surname' => 'Семейное положение: Фамилия',
            'DataFamily.*.patronymic' => 'Семейное положение: Отчество',
            'DataFamily.*.birthday' => 'Семейное положение: Дата рождения',
            'DataFamily.*.telephone' => 'Семейное положение: Номер телефона',
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
            'formData.candidateSurname' => 'required|max:255',
            'formData.candidateName' => 'required|max:255',
            'formData.candidatePatronymic' => 'required|max:255',
            'formData.candidateSex' => 'required|max:255',
            'formData.candidateBirthday' => 'required|date|max:255',
            'formData.candidateBirthplace' => 'required|max:255',
            'formData.candidateLanguages' => 'required|max:255',
            'formData.candidateAcademicDegree' => 'required|max:255',
            'formData.candidateScientificWork' => 'required|max:255',
            'formData.candidateMilitaryRank' => 'required|max:255',
            'formData.candidateMilitaryComposition' => 'required|max:255',
            'formData.candidateMilitaryBranch' => 'required|max:255',
            'formData.candidateHomeAddress' => 'required|max:255',
            'formData.candidatePhone' => 'required|regex:/^(\+7 \([0-9]{3}\))-[0-9]{3}-[0-9]{2}-[0-9]{2}$/|max:255',  # +7 (777)-777-77-77
            'formData.candidatePassportSeries' => 'required|regex:/(^[0-9]{4}$)/|max:255',
            'formData.candidatePassportNumber' => 'required|regex:/(^[0-9]{6}$)/|max:255',
            'formData.candidatePassportGiven' => 'required|max:255',
            'formData.candidateInn' => 'required|regex:/(^[0-9]{12}$)/|max:255',
            'formData.candidatePfr' => 'required|regex:/(^[0-9]{3}-[0-9]{3}-[0-9]{3}-[0-9]{2}$)/|max:255',
            'formData.candidateBiography' => 'required|max:3000',

            'DataEducation.*.institution' => 'required|max:255',
            'DataEducation.*.faculty' => 'required|max:255',
            'DataEducation.*.formStudy' => 'required|max:255',
            'DataEducation.*.admissionYear' => 'required|max:255',
            'DataEducation.*.graduationYear' => 'required|max:255',
            'DataEducation.*.graduationCourse' => 'required|max:255',
            'DataEducation.*.specialty' => 'required|max:255',
            'DataEducation.*.diploma' => 'required|max:255',

            'DataWork.*.entry' => 'required|date|max:255',
            'DataWork.*.exit' => 'required|date|max:255',
            'DataWork.*.position' => 'required|max:255',
            'DataWork.*.location' => 'required|max:255',

            'DataAbroad.*.sinceTime' => 'required|date|max:255',
            'DataAbroad.*.atTime' => 'required|date|max:255',
            'DataAbroad.*.country' => 'required|max:255',
            'DataAbroad.*.goal' => 'required|max:255',

            'DataAward.*.data' => 'required|date|max:255',
            'DataAward.*.reward' => 'required|max:255',

            'DataFamily.*.name' => 'required|max:255',
            'DataFamily.*.surname' => 'required|max:255',
            'DataFamily.*.patronymic' => 'required|max:255',
            'DataFamily.*.birthday' => 'required|date|max:255',
            'DataFamily.*.telephone' => 'required|regex:/^(\+7 \([0-9]{3}\))-[0-9]{3}-[0-9]{2}-[0-9]{2}$/|max:255',
        ];
    }
}


