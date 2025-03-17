<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Enums\Ticket;
use App\Enums\TicketStatus;
use App\Enums\TicketType;

class TicketRequest extends FormRequest
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
            'type' => ['required', new Enum(TicketType::class)],
            'status' => ['nullable', new Enum(TicketStatus::class)],
            'price' => ['required', 'integer'],
        ];
    }
}
