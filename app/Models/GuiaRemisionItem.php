<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuiaRemisionItem extends Model
{
    protected $table = 'guia_remision_items';

    protected $guarded = ['id'];

    protected $with = ['item'];

    const def_sequence = 'DEF_GUIA_SEQUENCE';


    public function guiaremision()
    {
        return $this->belongsTo(GuiaRemision::class,'guia_remision_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
