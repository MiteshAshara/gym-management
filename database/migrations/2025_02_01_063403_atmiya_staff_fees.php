<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('atmiya_staff_fees', function (Blueprint $table) {
            $table->id();
            $table->string('membership_duration'); 
            $table->decimal('fees_amount', 8, 2);
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atmiya_staff_fees');
    }
};
