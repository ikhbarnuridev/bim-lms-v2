<?php

namespace App\Http\Requests\Material;

use Illuminate\Foundation\Http\FormRequest;

class ReorderRequest extends FormRequest
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
            'from' => ['required', 'integer'],
            'to' => ['required', 'integer'],
        ];
    }

    public function attributes()
    {
        return [
            'from' => __('Urutan Awal'),
            'to' => __('Urutan Tujuan'),
        ];
    }
}
