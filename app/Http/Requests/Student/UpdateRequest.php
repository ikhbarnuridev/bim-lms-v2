<?php

namespace App\Http\Requests\Student;

use Illuminate\Contracts\Validation\Validator;
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
        return [
            'name' => ['required', 'string', 'max:255'],
            'nis' => ['required', 'string', 'unique:students,nis,'.$this->student->id],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $script = '
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const modalElement = document.getElementById("editModal");
                modalElement.classList.remove("fade");
                const modal = new coreui.Modal(modalElement);
                modal.show();
                modalElement.classList.add("fade");
            });
        </script>
        ';

        session()->flash('script', $script);
        session()->flash('student', $this->student);

        parent::failedValidation($validator);
    }
}
