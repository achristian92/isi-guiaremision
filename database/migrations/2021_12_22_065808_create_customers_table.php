<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ruc');
            $table->string('address');
            $table->timestamps();
        });

        \App\Models\Customer::create([
            'name' => 'Claro SAC',
            'ruc'  => '20113423241',
            'address' => 'Av. Larco 874 - Miraflores - Lima'
        ]);
        \App\Models\Customer::create([
            'name' => 'Movistar SAC',
            'ruc'  => '20913463242',
            'address' => 'Av. San Juan 23 - VES - Lima'
        ]);
        \App\Models\Customer::create([
            'name' => 'Entel SAC',
            'ruc'  => '20133463242',
            'address' => 'Av. Perez Torres 139 - Chorrillos - Lima'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
