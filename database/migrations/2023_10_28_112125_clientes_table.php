<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nomeFantasia')->nullable(false);
            $table->string('cnpj')->unique()->nullable(false);
            $table->string('endereco')->nullable(false);
            $table->string('cidade')->nullable(false);
            $table->string('estado', 2)->nullable(false);
            $table->string('pais')->nullable(false);
            $table->string('telefone')->nullable(false);
            $table->string('email')->unique()->nullable(false);
            $table->string('areaAtuacao')->nullable(false);
            $table->string('quadroSocietario')->nullable()->default('Não disponível');
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
        Schema::dropIfExists('clientes');
    }
}
