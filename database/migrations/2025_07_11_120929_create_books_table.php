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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('titre') ;
            $table->string('auteur') ;
            $table->integer('annee') ; 
            $table->enum('statut', ['lu', 'à lire', 'en cours'])->default('à lire') ;
            $table->boolean('favori')->default(false) ; 
            $table->text('note')->nullable() ;
            $table->timestamps() ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
