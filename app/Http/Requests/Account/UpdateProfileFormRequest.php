<?php

namespace Forum\Http\Requests\Account;

use Forum\Http\Requests\Request;

class UpdateProfileFormRequest extends Request
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
            'name' => 'max:32',
            'location' => 'max:64',
            'website' => 'url',
            'about' => 'max:128',
        ];
    }
}