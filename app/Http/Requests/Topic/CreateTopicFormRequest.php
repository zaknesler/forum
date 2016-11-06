<?php

namespace Forum\Http\Requests\Topic;

use Forum\Models\Topic;
use Illuminate\Foundation\Http\FormRequest;

class CreateTopicFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Topic::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:8|max:64',
            'body' => 'required|min:16',
        ];
    }
}
