<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhoneUpdateRequest extends FormRequest
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
            'contact_id' => ['required', 'integer', 'exists:contacts,id'],
            'type' => ['required', 'in:Home,Mobile,Office,School,Other'],
            'number' => ['required', 'string', 'max:25'],
            'softdeletes' => ['required'],
        ];
    }
}
