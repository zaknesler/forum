<?php

namespace Forum\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordFormRequest extends FormRequest
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
            'old_password' => 'required|min:6',
            'password' => 'required|min:6|confirmed|different:old_password',
        ];
    }
}
