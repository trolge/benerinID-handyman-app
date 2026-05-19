<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('WorkingHoursStart', 5)->default('09:00')->after('Tags');
            $table->string('WorkingHoursEnd', 5)->default('17:00')->after('WorkingHoursStart');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['WorkingHoursStart', 'WorkingHoursEnd']);
        });
    }
};
