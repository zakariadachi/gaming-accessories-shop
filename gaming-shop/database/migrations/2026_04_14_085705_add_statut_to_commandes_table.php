<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->enum('statut', ['en_attente', 'confirmée', 'expédiée', 'livrée', 'annulée'])
                  ->default('en_attente')
                  ->after('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->dropColumn('statut');
        });
    }
};
