<?php

namespace App\Http\Requests\Products;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'price' => ['required', 'numeric'],
            'imageFile' => ['required'], // as base 64
        ];
    }
}
