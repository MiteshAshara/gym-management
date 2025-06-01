<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('recovery_members', function (Blueprint $table) {
            if (!Schema::hasColumn('recovery_members', 'gender')) {
                $table->string('gender')->nullable()->after('contact_no');
            }
        });
    }

    public function down()
    {
        Schema::table('recovery_members', function (Blueprint $table) {
            if (Schema::hasColumn('recovery_members', 'gender')) {
                $table->dropColumn('gender');
            }
        });
    }
};
