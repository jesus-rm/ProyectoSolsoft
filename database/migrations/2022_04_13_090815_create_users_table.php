<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('personaId');
            $table->string('nombre',25);
            $table->string('apellidoPaterno',25);
            $table->string('apellidoMaterno',25)->nullable();
            $table->date('fechaNacimiento');
            $table->string('rfc',13)->unique();
            $table->string('curp',18)->unique();
            $table->string('telefono',10);
            $table->string('celular',10);
            $table->string('email',80)->unique();
            $table->tinyInteger('edad');
            $table->string('password',32);
            $table->foreignId('estado_id')->constrained('estados','estadoId')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('municipio_id')->constrained('municipios','municipioId')->onDelete('cascade')->onUpdate('cascade');
            $table->string('avatar')->default('default.png');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
