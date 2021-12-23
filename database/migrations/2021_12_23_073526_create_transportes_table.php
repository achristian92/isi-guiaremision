<?php

use App\Voucher\Sunat\TransferModes\TransferModeSunat;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transportes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('description');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $modes = [
            [
                'code'        => '01',
                'description' => 'Transporte público',
            ],
            [
                'code'        => '02',
                'description' => 'Transporte privado',
            ],
        ];

        foreach ($modes as $mode) {
            \App\Models\Transporte::create($mode);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transportes');
    }
}
