<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrackRequest extends FormRequest
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
        $rules = [
            'title' => ['required', 'string', 'min:5', 'max:255'],
            'artist' => ['required', 'string', 'min:5', 'max:50'],
            'display' => ['required', 'boolean'],
        ];

        if ($this->isMethod('post')) {
            $rules['music'] = ['required', 'file', 'mimes:mp3,wav'];
            $rules['image'] = ['nullable', 'file', 'image'];
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['music'] = ['nullable', 'file', 'mimes:mp3,wav'];
            $rules['image'] = ['nullable', 'file', 'image'];
        }

        return $rules;
    }
}