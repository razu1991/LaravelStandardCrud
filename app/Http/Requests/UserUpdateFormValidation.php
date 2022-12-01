<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateFormValidation extends FormRequest
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
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|unique:users,email,' . $this->id,
            'phone' => 'required|string|unique:users,phone,' . $this->id,
            'age' => 'required|numeric|between:0,100',
            'country' => 'nullable|string|max:100'
        ];
    }
}
