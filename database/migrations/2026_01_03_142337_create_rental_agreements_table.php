<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rental_agreements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apartment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // tenant
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->timestamps();
            $table->index(['apartment_id', 'start_date', 'end_date']);
            $table->index(['user_id', 'start_date', 'end_date']);
            $table->enum('status', ['pending', 'active', 'rejected'])
            ->default('pending');
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rental_agreements');
    }
};
