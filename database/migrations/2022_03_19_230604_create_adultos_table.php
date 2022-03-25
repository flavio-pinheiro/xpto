<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdultosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adultos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('cpf', 11);
            $table->date('nascimento');
            $table->string('fone',20);
            $table->enum('nacionalidade', ['Brasileiro(a)','Estrangeiro(a)']);
            $table->enum('parentesco', ['Mãe','Pai', 'Outros']);
            $table->string('foto', 20);
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
        Schema::dropIfExists('adultos');
    }
}
