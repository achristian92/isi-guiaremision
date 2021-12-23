<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuiaItemRequest  extends FormRequest
{
    public function rules() {
        return [
            'item_id'    => 'required',
            'quantity'  => 'required|integer',

        ];
    }

}
