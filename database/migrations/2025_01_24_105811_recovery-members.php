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
        Schema::create('recovery_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('membership_duration')->nullable();
            $table->string('contact_no');
            $table->string('department');
            $table->string('semester');
            $table->decimal('fees', 8, 2)->nullable();
            $table->string('payment_mode');
            $table->date('joining_date');
            $table->date('end_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recovery_members');
    }
};
