<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
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
        $method = strtolower($this->method());
        $user_id = $this->route()->user;

        $rules = [];
        switch ($method) {
            case 'post':
                $rules = [
                    'name' => 'required|max:191',
                    'password' => 'required|confirmed|min:6',
                    'email' => 'required|max:191|email|unique:users',
                    'userProfile' => [
                        'gender' => 'required',
                        'dob' => 'required',
                    ],
                ];
                break;
            case 'patch':
                $rules = [
                    'name' => 'required|max:191',
                    'email' => 'required|max:191|email|unique:users,email,'.$user_id,
                    'userProfile' => [
                        'gender' => 'required',
                        'dob' => 'required',
                    ],
                ];
                break;

        }

        return $rules;
    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator){
        $data = [
            'status' => true,
            'message' => $validator->errors()->first(),
            'all_message' =>  $validator->errors()
        ];

        if ($this->ajax()) {
            throw new HttpResponseException(response()->json($data,422));
        } else {
            throw new HttpResponseException(redirect()->back()->withInput()->with('errors', $validator->errors()));
        }
    }
}
