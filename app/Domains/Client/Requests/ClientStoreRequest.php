<?php

namespace App\Domains\Client\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientStoreRequest extends FormRequest
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
            'firstName'=>['required','string','min:2','max:32'],
            'lastName'=>['required','string','min:2','max:32'],
            'email'=>['required','email','unique:clients,email'],
            'phoneNumber'=>['required','unique:clients,phoneNumber'],
        ];
    }
}
