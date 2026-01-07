<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        Schema::table('rental_agreements', function (Blueprint $table) {
            // 1️⃣ първо махаме FK
            $table->dropForeign(['user_id']);

            // 2️⃣ после махаме колоната
            $table->dropColumn('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('rental_agreements', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();
        });
    }

};
