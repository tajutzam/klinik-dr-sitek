<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('national_id')->unique()->nullable(); // KTP / NIK
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();

            $table->text('address')->nullable();
            $table->string('phone_number', 20)->nullable();

            $table->timestamps();

            // Indexing for performance
            $table->index('name');
            $table->index('phone_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
