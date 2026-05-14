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
        Schema::table('handyman_jobs', function (Blueprint $table) {
            $table->dateTime('JobStartDate')->nullable()->after('JobDuration');
            $table->dateTime('JobEndDate')->nullable()->after('JobStartDate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('handyman_jobs', function (Blueprint $table) {
            $table->dropColumn(['JobStartDate', 'JobEndDate']);
        });
    }
};
