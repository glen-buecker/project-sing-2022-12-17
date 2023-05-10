<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUpdateRequest extends FormRequest
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
            'first' => ['required', 'string', 'max:25'],
            'last' => ['required', 'string', 'max:25'],
            'preferred' => ['string', 'max:25'],
            'address1' => ['string', 'max:100'],
            'address2' => ['string', 'max:100'],
            'city' => ['string', 'max:50'],
            'state' => ['string', 'max:50'],
            'zip' => ['string', 'max:25'],
            'country' => ['string', 'max:100'],
            'notes' => ['required', 'string'],
            'softdeletes' => ['required'],
        ];
    }
}
