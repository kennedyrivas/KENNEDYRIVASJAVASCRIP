<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserVendeRequest extends FormRequest
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
            'nombre' => ['required', 'string', 'max:255', 'min:1'],
            'apellido' => ['required', 'string', 'max:255', 'min:1'],
            'cedula' => ['required', 'string', 'max:20', 'min:1'],
            'telefono' => ['nullable' ,'string'],
            'email' => ['required', 'email'],
            'password' => ['required']
        ];
    }
}
