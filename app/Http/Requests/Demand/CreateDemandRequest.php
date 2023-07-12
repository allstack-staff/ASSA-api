<?php

namespace App\Http\Requests\Demand;

use App\Exceptions\DomainException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreateDemandRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'min:5|required|string|max:255',
            'description' => 'min:50|required|string|max:255',
            'priority' => 'min:1|required|string|max:255',
            'status' => 'min:5|required|string|max:255',
            'deadline' => 'nullable|date'
        ];
    }

    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new DomainException($validator->messages()->all(), 422);
    }
}
