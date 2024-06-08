<?php

namespace App\Http\Requests;

use App\Support\ApiReturnResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class BaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            ApiReturnResponse::validationError($errors)->send()
        );
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function (){
            //insert rule inside
        });
    }
}
