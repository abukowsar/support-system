<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KnowledgeRequest extends FormRequest
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
            'title'        => 'required|max:191',
            'category_id'  => 'required',
            'status'       => 'required',
        ];
    }

    public function messages()
    {
        return [
            'category_id.*'  =>'Category is required.',
        ];
    }
}
