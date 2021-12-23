<?php

namespace App\Requests;

use App\Models\GuiaRemision;
use Illuminate\Foundation\Http\FormRequest;

class GuiaTransporteRequest  extends FormRequest
{
    public function rules() {
        $guia = GuiaRemision::find($this->id);
        if ($guia->modality_id == '1')
            return [
                'trans_ruc_pub'        => 'filled|required',
                'trans_type_doc_pub'   => 'filled|required',
                'trans_razon_name_pub' => 'filled|required',
            ];
        else
        return [

            'trans_placa_pri' => 'filled|required',
            'trans_type_doc_priv' => 'filled|required',
            'trans_nro_doc_priv' => 'filled|required|size:8',
        ];
    }

}
