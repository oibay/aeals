<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportGuest extends FormRequest
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
            'file' => 'required|file|mimes:xlsx',
            'entry' => 'required|date_format:"Y-m-d\TH:i"',
            'departure' => 'required|date_format:"Y-m-d\TH:i"',
            'location' => 'required',
        ];
    }

    /**
     * Redetermine validate messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'file.required' => 'Загрузите файл',
            'file.file' => 'Неккоректный формат',
            'file.mimes' => 'Загрузите Excel файл',
            'user_id.required' => 'Заполните это поле',
            'user_id.integer' => 'Неверный формат',
            'entry.required' => 'Заполните это поле',
            'entry.date_format' => 'Неверный формат',
            'departure.required' => 'Заполните это поле',
            'departure.date_format' => 'Неверный формат',
        ];
    }
}
