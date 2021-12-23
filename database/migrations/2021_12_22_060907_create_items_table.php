<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('unit');
            $table->timestamps();
        });

        $data = ['Cámara digital','Laptop HP 16GB','Grabadora de Video x2021','Smartphone IPhone 12','Teclado r203'];
        foreach ($data as $key => $dat) {
            \App\Models\Item::create([
                'name' => $dat,
                'unit' => 'NIU',
                'code' => "P".$key+rand(100,500)
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
