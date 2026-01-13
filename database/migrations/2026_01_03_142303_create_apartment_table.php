<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('address');
            $table->decimal('price', 18, 2);
            $table->unsignedInteger('area');
            $table->timestamps();
            $table->foreignId('owner_id')
            ->nullable()
            ->constrained('users')
            ->nullOnDelete();
                });
    }

    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};
