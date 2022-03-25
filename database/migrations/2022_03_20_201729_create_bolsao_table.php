<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBolsaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bolsas', function (Blueprint $table) {
            $table->id();
            $table->integer('vagas');
            $table->datetime('inicio');
            $table->datetime('fim');
            $table->datetime('sorteio');
            $table->string('curso', 50);
            $table->enum('status', ['Abertas','Finalizado', 'Cancelado']);
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
        Schema::dropIfExists('bolsas');
    }
}
