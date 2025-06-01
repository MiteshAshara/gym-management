<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations to add missing columns to recovery_members table.
     */
    public function up()
    {
        Schema::table('recovery_members', function (Blueprint $table) {
            // First check if columns don't exist to avoid errors
            if (!Schema::hasColumn('recovery_members', 'age')) {
                $table->integer('age')->nullable();
            }
            
            if (!Schema::hasColumn('recovery_members', 'birth_date')) {
                $table->date('birth_date')->nullable();
            }
            
            if (!Schema::hasColumn('recovery_members', 'height_in_inches')) {
                $table->integer('height_in_inches')->nullable();
            }
            
            if (!Schema::hasColumn('recovery_members', 'weight')) {
                $table->integer('weight')->nullable();
            }
            
            if (!Schema::hasColumn('recovery_members', 'current_status')) {
                $table->string('current_status')->nullable();
            }
            
            if (!Schema::hasColumn('recovery_members', 'reference')) {
                $table->string('reference')->nullable();
            }
            
            if (!Schema::hasColumn('recovery_members', 'medical_conditions')) {
                $table->text('medical_conditions')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('recovery_members', function (Blueprint $table) {
            $table->dropColumn([
                'age',
                'birth_date',
                'height_in_inches',
                'weight',
                'current_status',
                'reference',
                'medical_conditions'
            ]);
        });
    }
};
