<?php

namespace Forum\Http\Requests\Forum\Section;

use Forum\Http\Requests\Request;

class EditSectionFormRequest extends Request
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
            'slug' => 'required|max:255|unique:sections,slug,' . $this->id,
        ];
    }
}
