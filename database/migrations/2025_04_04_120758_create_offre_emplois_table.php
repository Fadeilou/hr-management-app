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
        Schema::create('offre_emplois', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('requirements');
            $table->string('salary_range')->nullable();
            $table->string('location');
            $table->string('department');
            $table->enum('status', ['brouillon', 'publiee', 'fermee'])->default('brouillon');
            $table->foreignId('recruiter_id')->constrained('employes')->onDelete('cascade'); // Lien vers la table employes
            $table->date('deadline');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offre_emplois');
    }
};
