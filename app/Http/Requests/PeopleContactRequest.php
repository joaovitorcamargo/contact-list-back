<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeopleContactRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'contacts' => [
                'required',
                'array',
                function ($attribute, $value, $fail) {
                    $this->validateContactInfo($attribute, $fail);
                },
            ],
        ];
    }

    private function validateContactInfo($attribute, $fail)
    {
        $contacts = $this->input('contacts.*');
        foreach ($contacts as $contact) {
            if (!isset($contact['type']) || !isset($contact['contact_info'])) {
                $fail($attribute . ' is invalid.');
                return;
            }

            if ($this->isInvalidContact($contact)) {
                $fail($attribute . ' is invalid for contact type.');
                return;
            }
        }
    }

    private function isInvalidContact($contact)
    {
        if (in_array($contact['type'], ['whatsapp', 'phone']) && !ctype_digit($contact['contact_info'])) {
            return true;
        }

        if ($contact['type'] === 'email' && !filter_var($contact['contact_info'], FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        return false;
    }
}
