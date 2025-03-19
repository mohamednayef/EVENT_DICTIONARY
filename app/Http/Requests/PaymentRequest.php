<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;

class PaymentRequest extends FormRequest
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
        return [
            'user_id' => ['required', 'integer'],
            'event_id' => ['required', 'integer'],
            'payment_method' => ['required', new Enum(PaymentMethod::class)],
            'payment_status' => ['required', new Enum(PaymentStatus::class)],
            'total_price' => ['required', 'numeric'],
        ];
    }
}
