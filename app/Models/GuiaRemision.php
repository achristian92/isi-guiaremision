<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuiaRemision extends Model
{
    protected $table = 'guia_remisiones';

    protected $with = ['customer','items','motivo','transporte'];

    protected $guarded = ['id'];

    protected $dates = [
        'delivery_date'
    ];

    public function items()
    {
        return $this->hasMany(GuiaRemisionItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function motivo()
    {
        return $this->belongsTo(Motivo::class,'reason_id');
    }
    public function transporte()
    {
        return $this->belongsTo(Transporte::class,'modality_id');
    }

}
