<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('package_sizes', function (Blueprint $table) {
    
            // Add new columns AFTER height
            $table->string('sheet_size')->nullable()->after('height');
            $table->string('color')->nullable()->after('sheet_size');
            $table->string('ply')->nullable()->after('color');
            $table->string('paper')->nullable()->after('ply');
            $table->string('nali')->nullable()->after('paper');
    
            // Remove weight column
            if (Schema::hasColumn('package_sizes', 'weight')) {
                $table->dropColumn('weight');
            }
        });
    }
    
    public function down(): void
    {
        Schema::table('package_sizes', function (Blueprint $table) {
    
            // Add back weight if rollback
            $table->decimal('weight', 8, 2)->nullable();
    
            // Drop newly added columns
            $table->dropColumn([
                'sheet_size',
                'color',
                'ply',
                'paper',
                'nali'
            ]);
        });
    }
};
