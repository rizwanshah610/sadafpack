<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('package_sizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('name');                          // Small, Medium, Large
            $table->decimal('length', 8, 2)->nullable();    // cm
            $table->decimal('width', 8, 2)->nullable();     // cm
            $table->decimal('height', 8, 2)->nullable();    // cm
            $table->decimal('weight', 8, 2)->nullable();    // kg
            $table->string('unit')->default('cm');          // cm / inch / mm
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('package_sizes');
    }
};