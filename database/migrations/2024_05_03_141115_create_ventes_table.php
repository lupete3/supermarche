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
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->decimal('quantite');
            $table->decimal('prix_vente');
            $table->decimal('prix_tot');
            $table->decimal('bonus')->default(0);
            $table->foreignId('commande_id')->references('id')->on('commandes')->onDelete('cascade');
            $table->foreignId('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventes');
    }
};
