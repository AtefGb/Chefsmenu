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
        
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->decimal('prix_HT', 8,2);
            $table->decimal('tva', 5,2);
            $table->decimal('prix_TTC', 8,2);
            $table->foreignId('table_id')->constrained()->onDelete('cascade');
            $table->foreignId('detail_commande_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
