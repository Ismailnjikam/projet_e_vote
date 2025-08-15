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
        Schema::create('candidats', function (Blueprint $table) {
            $table->id();
             $table->string('nom');
             $table->string('photo')->nullable();
            $table->foreignId('scrutin_id')->constrained('scrutins')->onDelete('cascade');
            $table->foreignId('filiere_id')->constrained('filieres');
           $table->text('thematique')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidats');
    }
};
