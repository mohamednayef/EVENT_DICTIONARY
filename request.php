<?php 

function rules(): array
{
    return [
        // Required Fields
        'name' => ['required', 'string', 'max:40'],
        'email' => ['required', 'email', 'unique:users,email'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],

        // Date & Time Validation
        'birthdate' => ['required', 'date'], // Ensures a valid date
        'appointment_time' => ['required', 'date_format:H:i'], // Time format HH:MM
        'created_at' => ['required', 'date_format:Y-m-d H:i:s'], // Datetime format

        // Numeric Validation
        'age' => ['required', 'integer', 'min:18', 'max:60'], // Number between 18 and 60
        'salary' => ['required', 'numeric', 'min:1000', 'max:5000'], // Min and max salary

        // Strings with Min & Max Length
        'username' => ['required', 'string', 'min:5', 'max:30', 'unique:users,username'],
        'phone' => ['required', 'string', 'size:11', 'unique:users,phone'], // Exactly 11 characters
        'description' => ['nullable', 'string', 'max:255'], // Optional field

        // Boolean Validation
        'is_active' => ['required', 'boolean'], // Accepts true, false, 1, 0

        // File Upload
        'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Max 2MB

        // Array Validation
        'tags' => ['nullable', 'array'],
        'tags.*' => ['string', 'max:20'], // Each tag must be a string with max length of 20

        // Enum Validation (Example)
        'gender' => ['required', 'in:male,female,other'], // Accepts only specific values

        // Exists & Unique Constraints
        'category_id' => ['required', 'exists:categories,id'], // Ensures category exists in DB
    ];
}