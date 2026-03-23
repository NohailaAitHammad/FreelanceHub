<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class MissionRequest extends FormRequest
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
            "title" => ["sometimes",'required', 'string', 'max:255'],
            "description" => ["sometimes",'required', 'string', 'max:255'],
            "budget" => ["sometimes",'required', 'integer', 'min:0.00'],
            "duration" => ["sometimes",'required', 'int', 'min:0'],
            'category_id' => ["sometimes","required", "exists:categories,id"]
        ];
    }
}
