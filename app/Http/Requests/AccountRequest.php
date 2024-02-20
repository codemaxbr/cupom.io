<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
                    'domain' => 'required|string|max:191|unique:accounts,domain',
                    'name_business' => 'required|string|max:191',
                    'name' => 'required|string|max:191',
                    'email' => 'required|string|email|max:191|unique:users',
                    'password' => 'required|string|min:6',
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
            'domain.unique' => 'O domínio já está em uso, tente outro.',
        ];
    }

    /*
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json(array('errors' => $validator->errors()), 200));
    }
    */
}
