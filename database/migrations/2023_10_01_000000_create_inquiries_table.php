<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInquiriesTable extends Migration
{
    public function up()
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->enum('gender', ['male', 'female']);
            $table->integer('age');
            $table->date('birth_date');  // Added required birth_date field
            $table->integer('height_in_inches');
            $table->integer('weight');
            $table->string('mobile')->unique();
            $table->string('current_status');  // Added required current_status field
            $table->string('reference')->nullable();  // Added nullable reference field
            $table->text('medical_conditions')->nullable();  // Added nullable medical_conditions field
            $table->enum('status', ['hot', 'cold', 'pending'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inquiries');
    }
}
