<?php

namespace App\Http\Requests\Material;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255', 'unique:materials,title,'.$this->material->id],
            'description' => ['required', 'string'],
            'cover' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];

        if (auth()->user()->isAdmin()) {
            $rules['teacher_id'] = ['required', 'exists:users,id'];
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'teacher_id' => __('Teacher'),
        ];
    }
}
