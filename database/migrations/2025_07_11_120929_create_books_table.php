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
            $table->foreignId("author_id")->constrained('authors')->onDelete('cascade') ;
            $table->foreignId("statut_id")->constrained('statuts')->onDelete('cascade') ;
            $table->string('titre') ;
            $table->integer('annee') ; 
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
