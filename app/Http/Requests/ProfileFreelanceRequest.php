<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileFreelanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "bio" => ["sometimes", "required", "string", 'max:255'],
            "experience" => ["sometimes", "required", "int", 'min:0'],
            "availability" => ["sometimes", "required", "bool"],
            'competences' => ['required','array'],
            'competences.*' => ['exists:competences,id'],

            'technologies' => ['required','array'],
            'technologies.*' => ['exists:technologies,id']
        ];
    }
}
