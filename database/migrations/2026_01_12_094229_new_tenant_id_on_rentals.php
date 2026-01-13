<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('rental_agreements', function (Blueprint $table) {

            if (!Schema::hasColumn('rental_agreements', 'tenant_id')) {
                $table->foreignId('tenant_id')
                      ->nullable()
                      ->constrained('users')
                      ->cascadeOnDelete()
                      ->after('apartment_id');
            }
        });

        if (Schema::hasColumn('rental_agreements', 'user_id')) {
            DB::statement('UPDATE rental_agreements SET tenant_id = user_id');
        }

        Schema::table('rental_agreements', function (Blueprint $table) {
            if (Schema::hasColumn('rental_agreements', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }

            $table->foreignId('tenant_id')->nullable(false)->change();
        });
    }
};
