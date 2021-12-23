<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sequence extends Model
{

    protected $guarded = ['id'];

    public function getNextDocumentId() {
        $docId = $this->next_id;
        $this->next_id++;
        $this->last_date_used = \Carbon\Carbon::now();
        $this->save();

        return $docId;
    }

    public function getDocumentReference($id = 0): string
    {
        $format = $this->prefix.'001'.$this->separator.intval($id);

        return $format;
    }


    static function findByName($name) {
        return \App\Voucher\General\Sequences\Sequence::where('name',$name)->first();
    }


}
