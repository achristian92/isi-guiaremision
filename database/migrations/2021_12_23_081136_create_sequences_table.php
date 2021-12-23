<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSequencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sequences', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 128);
            $table->string('description', 128);
            $table->string('prefix', 8)->nullable()->default(NULL);
            $table->tinyInteger('length')->unsigned();					// Document id will be left padded with 0'es to this length
            $table->string('separator', 3)->nullable()->default(NULL);	// To show between document_prefix and document_id
            $table->integer('next_id')->unsigned();
            $table->timestamp('last_date_used')->nullable()->default(NULL);
            $table->timestamps();
        });

        \App\Models\Sequence::create([
                'name'    => 'DEF_GUIA_SEQUENCE',
                'description' => 'Guía Remisión',
                'prefix'    => 'T',
                'length'    => '4',
                'separator'    => '-',
                'next_id'     => '1',
                'active'    => '1' ,
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sequences');
    }
}
