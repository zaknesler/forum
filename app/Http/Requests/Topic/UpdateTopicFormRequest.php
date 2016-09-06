<?php

namespace Forum\Http\Requests\Topic;

use Forum\Topic;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTopicFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->route('topic'));
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
            'body' => 'required|min:32',
        ];
    }
}
