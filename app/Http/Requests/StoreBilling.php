<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBilling extends FormRequest
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
            'societe' => ['required_if:store_id,null'],
            'adresse1' => ['required_if:store_id,null'],
            'cp' => ['required_if:store_id,null'],
            'ville' => ['required_if:store_id,null'],
        ];
    }

    /**
     * Get the custom messages that apply to the request.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'societe.required_if' => 'La société est obligatoire si vous ne choisissez pas un établissement dans la liste ci-dessous.',
            'adresse1.required_if' => 'Une adresse est obligatoire si vous ne choisissez pas un établissement dans la liste ci-dessous.',
            'cp.required_if' => 'Un code postal est obligatoire si vous ne choisissez pas un établissement dans la liste ci-dessous.',
            'ville.required_if' => 'Une ville est obligatoire si vous ne choisissez pas un établissement dans la liste ci-dessous.',
        ];
    }

}
