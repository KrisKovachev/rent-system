<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rental_requests', function (Blueprint $table) {

            // ако има user_id – махаме го
            if (Schema::hasColumn('rental_requests', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }

            // добавяме tenant_id
            if (!Schema::hasColumn('rental_requests', 'tenant_id')) {
                $table->foreignId('tenant_id')
                    ->constrained('users')
                    ->cascadeOnDelete()
                    ->after('apartment_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('rental_requests', function (Blueprint $table) {
            $table->dropForeign(['tenant_id']);
            $table->dropColumn('tenant_id');
        });
    }
};
