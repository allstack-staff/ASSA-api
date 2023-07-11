<?php

namespace App\Http\Requests\SquadUser;

use App\Exceptions\DomainException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSquadUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'role' => 'min:5|required|string|max:255'
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
