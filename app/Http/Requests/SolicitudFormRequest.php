<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SolicitudFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'descripcion' => 'required',
            'observacion' => 'required',
            'costo' => 'required',
            'cliente_id' => 'required',
            'empresa_id' => 'required',
            'sucursal_id' => 'required',
            'destinatario_id' => 'required',
            'direccion_destinatario_id' => 'required'
        ];
    }
}
