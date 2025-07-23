<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
            'nombre' => ['required', 'string', 'min:1', 'max:255'],
            'apellido' => ['required', 'string', 'min:1', 'max:255'],
            'cedula' => ['required', 'string', 'min:1', 'max:20'],
            'email' => ['required', 'email', 'max:255'],
            'direccion' => ['required', 'string', 'min:1', 'max:255'],
            'telefono' => ['required', 'string', 'min:1', 'max:20']
        ];
    }
}
