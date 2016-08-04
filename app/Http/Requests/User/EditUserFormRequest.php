<?php

namespace Forum\Http\Requests\User;

use Forum\Http\Requests\Request;

class EditUserFormRequest extends Request
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
            'username'   => 'required|max:32|unique:users,username,'.$this->id,
            'about'      => 'max:300',
            'first_name' => 'max:32',
            'last_name'  => 'max:32',
            'location'   => 'max:64',
            'website'    => 'url',
        ];
    }
}
