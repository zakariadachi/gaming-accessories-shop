<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')->constrained('commandes')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('stripe_session_id')->unique();
            $table->decimal('montant', 10, 2);
            $table->decimal('reduction', 10, 2)->default(0);
            $table->decimal('montant_final', 10, 2);
            $table->string('devise', 3)->default('EUR');
            $table->enum('statut', ['en_attente', 'payee', 'echouee', 'remboursee'])->default('en_attente');
            $table->integer('points_utilises')->default(0);
            $table->integer('points_gagnes')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
