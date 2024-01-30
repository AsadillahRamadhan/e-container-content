<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loading_docks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', ['box', 'pt37', 'pt56', 'oricon']);
            $table->string('invoice_number')->nullable();
            $table->string('dr_number');
            $table->string('document_number');
            $table->string('container_number')->nullable();
            $table->enum('size', [20, 40]);
            $table->integer('pt11')->nullable();
            $table->integer('app_jpr')->nullable();
            $table->integer('total_set');
            $table->integer('total_poly');
            $table->integer('total_palet');
            $table->string('document_link');
            $table->json('data')->nullable();
            $table->date('date');
            $table->boolean('is_checked')->nullable();
            $table->boolean('approved_by_ppc')->nullable();
            $table->boolean('approved_by_admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loading_docks');
    }
};
