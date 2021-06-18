<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuestEditRequest extends FormRequest
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
            'name' => 'required|max:255',
            'user_id' => 'required|integer',
            'phone' => 'required',
            'location' => 'required',
            'passport' => [ 'required'],
            'entry' => 'required|date_format:"Y-m-d\TH:i"',
            'departure' => 'required|date_format:"Y-m-d\TH:i"|after:entry',
            'breakfast' => 'in:Завтрак',
            'lunch' => 'in:Обед',
            'supper' => 'in:Ужин',
            'room_type' => 'required',
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'name.required' => 'Заполните это поле',
            'name.max' => 'Слишком длинное имя',
            'user_id.required' => 'Заполните это поле',
            'user_id.integer' => 'Неверный формат',
            'phone.required' => 'Заполните это поле',
            'passport.required' => 'Заполните это поле',
            'passport.max' => 'Введите 12 цифр',
            'passport.min' => 'Введите 12 цифр',
            'passport.integer' => 'ИИН должен содержать только цифры',
            'entry.required' => 'Заполните это поле',
            'entry.date_format' => 'Неверный формат',
            'departure.required' => 'Заполните это поле',
            'departure.date_format' => 'Неверный формат',
            'departure.after' => 'Дата отъезда должна быть больше',
            'breakfast.in' => 'Неверный формат',
            'lunch.in' => 'Неверный формат',
            'supper.in' => 'Неверный формат',
        ];
    }
}
