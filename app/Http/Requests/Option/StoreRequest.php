<?php

namespace App\Http\Requests\Option;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'label' => ['required', 'string', 'max:255'],
            'is_correct' => ['required', 'integer'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $script = '
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const modalElement = document.getElementById("createModal");
                modalElement.classList.remove("fade");
                const modal = new coreui.Modal(modalElement);
                modal.show();
                modalElement.classList.add("fade");
            });
        </script>
        ';

        session()->flash('script', $script);

        parent::failedValidation($validator);
    }
}
