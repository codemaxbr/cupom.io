<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CustomerRequest extends FormRequest
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
        switch($this->method())
        {
            case 'GET':
                //..
            break;

            case 'POST':
                return [
                    'name' => 'required|string|max:191',
                    'email' => 'required|string|email|max:191',
                    'cpf_cnpj' => 'required|string',
                ];
            break;

            case 'PUT':
                return [
                    'name' => 'required|string|max:191',
                    'email' => 'required|string|email|max:191',
                    'cpf_cnpj' => 'required|string',
                ];
            break;

            case 'DELETE':
                return [
                    'item' => 'required'
                ];
            break;
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo Nome / Razão Social deve ser preenchido.'
        ];
    }

    /*
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json(array('errors' => $validator->errors()), 200));
    }
    */
}
