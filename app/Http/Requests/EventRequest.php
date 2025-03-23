<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\validation\Rules\Enum;
use App\Enums\Category;

class EventRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // return ["here"];
        return [
            'category_id' => ['required', 'integer'],
            'category' => ['required', 'string'],
            'name' => ['required', 'string', 'min:4', 'max:50'],
            'description' => ['required', 'string', 'max:400'],
            'date' => ['required', 'date_format:Y-m-d'],
            'location' => ['required', 'string'],
            'capacity' => ['required', 'integer', 'min:1', 'max:5000'],
            'price' => ['required', 'numeric'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'the name is required',
            'name.string' => 'the name should be string',
        ];
    }

}
