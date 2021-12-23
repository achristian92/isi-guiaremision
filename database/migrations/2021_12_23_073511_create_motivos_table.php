<?php

use App\Models\Motivo;
use App\Voucher\Sunat\TransferReasons\TransferReasonSunat;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMotivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motivos', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('description');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $reasons = [
            [
                'code'        => '01',
                'description' => 'Venta',
            ],
            [
                'code'        => '02',
                'description' => 'Compra',
            ],
            [
                'code'        => '04',
                'description' => 'Translado entre establecimiento de la misma empresa',
            ],
            [
                'code'        => '08',
                'description' => 'Importación',
            ],
            [
                'code'        => '09',
                'description' => 'Exportación',
            ],
            [
                'code'        => '13',
                'description' => 'Otros',
            ],
            [
                'code'        => '14',
                'description' => 'Venta sujeta a confirmación del comprador',
            ],
            [
                'code'        => '18',
                'description' => 'Translado emisor itinerante CP',
            ],
            [
                'code'        => '19',
                'description' => 'Translado a zona primaria',
            ],
        ];

        foreach ($reasons as $reason) {
            Motivo::create($reason);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('motivos');
    }
}
