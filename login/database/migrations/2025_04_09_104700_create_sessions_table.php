<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();               // ID da sessão (geralmente um hash)
            $table->unsignedInteger('user_id')->nullable(); // ID do usuário associado à sessão
            $table->string('ip_address', 45)->nullable();   // IP do usuário
            $table->text('user_agent')->nullable();         // User agent do navegador
            $table->text('payload');                        // Dados serializados da sessão
            $table->integer('last_activity');               // Timestamp da última atividade

            $table->timestamps(); // Adiciona created_at e updated_at (se desejado)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}
