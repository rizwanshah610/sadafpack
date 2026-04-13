<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('package_sizes', function (Blueprint $table) {
            $table->string('name')->after('product_id');
            $table->decimal('weight', 8, 2)->nullable()->after('height');
            $table->string('unit')->nullable()->after('weight');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('package_sizes', function (Blueprint $table) {
            $table->dropColumn(['name', 'weight', 'unit']);
        });
    }
};
