<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuiaRemisionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guia_remisiones', function (Blueprint $table) {
            $table->id();
            $table->integer('sequence_id')->unsigned()->nullable();
            $table->string('document_prefix', 8)->nullable();                   // From Sequence. Needed for index.
            $table->integer('document_id')->unsigned()->default(0);
            $table->string('document_reference', 64)->nullable();               // document_prefix + document_id of document
            $table->string('reference')->nullable();

            $table->string('supplier_ruc')->default('10474727551');
            $table->string('supplier_name')->default('Alan Ruiz Aguirre');
            $table->string('supplier_address')->default('Av. Benavides 234 - Miraflores - Lima');
            $table->string('description')->nullable();
            $table->date('delivery_date')->nullable();
            $table->unsignedInteger('customer_id')->nullable();
            $table->unsignedInteger('modality_id')->nullable();
            $table->unsignedInteger('reason_id')->nullable();
            $table->integer('weight')->default(1);
            $table->string('trans_ruc_pub')->nullable();
            $table->string('trans_type_doc_pub')->nullable();
            $table->string('trans_razon_name_pub')->nullable();
            $table->string('trans_placa_pri')->nullable();
            $table->string('trans_type_doc_priv')->nullable();
            $table->string('trans_nro_doc_priv')->nullable();
            $table->string('name_xml')->nullable();
            $table->text('msg_sunat')->nullable();
            $table->text('src_cdr')->nullable();
            $table->integer('estado_sunat')->default(0); // 0=no enviado, 1 = Aceptado
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guia_remisiones');
    }
}
