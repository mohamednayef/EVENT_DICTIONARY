<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use App\Enums\Role;
use App\Enums\Gender;

class UserRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return [
                'email' => 'required|email|unique:users,email',
            ];
            return $this->onCreate();
        } else {
            return $this->onUpdate();
        }
    }

    private function onCreate(): array
    {
        return [
            'fname' => ['required','string' ,'regex:/^[a-zA-Z][a-zA-Z0-9]{3,15}$/'],
            'lname' => ['required','string' ,'regex:/^[a-zA-Z][a-zA-Z0-9]{3,15}$/'],
            'username' => ['required|unique:users,username', 'regex:/^[a-zA-Z][a-zA-Z0-9]{3,15}$/'],
            'phone' => ['nullable', 'regex:/^(010|011|012|015)[0-9]{8}$/', 'unique:users,phone'],
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|max:16',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'gender' => ['required', new Enum(Gender::class)],
            'role' => ['required', new Enum(Role::class)],
        ];
    }
    
    private function onUpdate(): array
    {
        return [
            'fname' => ['sometimes', 'string', 'max:30'],
            'lname' => ['sometimes', 'string', 'max:30'],
            'username' => ['sometimes', 'string', 'max:30', Rule::unique('users', 'username')->ignore($this->id)],
            'email' => ['sometimes', 'email', Rule::unique('users', 'email')->ignore($this->id)],
            'email_verified_at' => ['sometimes', now()],
            'password' => 'sometimes|min:8',
            'phone' => ['sometimes', 'required', 'string', 'max:11', Rule::unique('users', 'phone')->ignore($this->id)],
            'image_path' => ['sometimes', null],
            'gender' => ['sometimes', 'M'],
            'role' => ['sometimes', new Enum(Role::class)],
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'The email address is already registered. Please use a different one.',
        ];
    }
}
