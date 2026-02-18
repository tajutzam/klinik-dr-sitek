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
        Schema::create('visit_medicines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')
                ->constrained('visits')
                ->cascadeOnDelete();

            $table->foreignId('medicine_id')
                ->constrained('medicines')
                ->restrictOnDelete();

            $table->integer('quantity');
            $table->decimal('unit_price', 12, 2);
            $table->decimal('subtotal', 12, 2);
            $table->string('dosage_instruction')->nullable();

            $table->timestamps();

            $table->index('visit_id');
            $table->index('medicine_id');

            $table->unique(['visit_id', 'medicine_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visit_medicines');
    }
};
