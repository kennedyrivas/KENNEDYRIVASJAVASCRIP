<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecepcionRequest extends FormRequest
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
            'proveedor_id' => ['required', 'string'],
            'formaPago_id' => ['required', 'string'],
            'fechaVencimiento' => ['nullable', 'date'],
            'cantidadCuota' => ['nullable', 'integer'],
            'numFactura' => ['required', 'string'],
            'fechaFactura' => ['required', 'date'],
            'fechaRecepcion' => ['required', 'date'],
            'montoBruto' => ['required'],
            'descuento' => ['required'],
            'montoNeto' => ['required'],
            'observacion' => ['nullable', 'string', 'max:255'],
            'producto' => ['required', 'array'],
            'cantidad' => ['required', 'array'],
            'costo' => ['required', 'array'],
            'ganancia' => ['required', 'array']
        ];
    }
}
