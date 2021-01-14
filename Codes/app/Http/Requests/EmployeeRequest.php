<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmployeeRequest extends FormRequest
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
        $id = $this->route()->employee;

        $rules = [];
        switch ($method) {
            case 'post':
                $rules = [
                    'name' => 'required|max:191',
                    'password' => 'required|confirmed|min:6',
                    'email' => 'required|max:191|email|unique:employees',
                    'role_id' => 'required',
                    'department_id'=>'required',
                    'profile' => [
                        'gender' => 'required',
                        'dob' => 'required',
                    ],
                ];
                break;
            case 'patch':
                $rules = [
                    'name' => 'required|max:191',
                    'email' => 'required|max:191|email|unique:employees,email,'.$id,
                    'role_id' => 'required',
                    'department_id'=>'required',
                    'profile' => [
                        'gender' => 'required',
                        'dob' => 'required',
                    ],
                ];
                break;

        }

        return $rules;
    }


}
