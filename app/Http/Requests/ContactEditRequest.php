<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactEditRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'type' => 'required|string|in:whatsapp,phone,email',
            'contact_info' => 'required|string',
        ];

        if ($this->has('type')) {
            $type = $this->input('type');

            if ($type === 'whatsapp' || $type === 'phone') {
                $rules['contact_info'] .= '|regex:/^\d+$/';
            }
            if ($type === 'email') {
                $rules['contact_info'] .= '|email';
            }
        }

        return $rules;
    }
}
