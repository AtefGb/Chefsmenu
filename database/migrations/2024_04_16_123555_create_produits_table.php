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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->enum('categorie', ['entrée', 'plat', 'dessert', 'boisson']);
            $table->decimal('prix_HT', 8,2);
            $table->decimal('tva', 5,2);
            $table->decimal('prix_TTC', 8,2);
            $table->string('image')->nullable();
            $table->string("description")->nullable();
            $table->foreignId('restaurant_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
