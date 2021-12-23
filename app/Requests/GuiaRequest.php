<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuiaRequest extends FormRequest
{
    public function rules() {
        return [
            'customer_id'    => 'required',
            'delivery_date'  => 'required|date',
            'modality_id'    => 'required',
            'reason_id'      => 'required',
            'weight'         => 'required',
        ];
    }

    public function messages()
    {
        return [
            'customer_id.required' => "Cliente es obligatorio(Guía)",
            'delivery_date.date'   => "Fecha de envio debe ser fecha(Guía)",
            'modality_id.required' => "Modalidad no existe(Guía)",
            'reason_id.required'   => "Motivo no existe(Guía)",
        ];
    }
}
