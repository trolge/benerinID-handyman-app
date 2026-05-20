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
        if (!Schema::hasColumn('ratings', 'feedback')) {
            Schema::table('ratings', function (Blueprint $table) {
                $table->text('feedback')->nullable()->after('Rating');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('ratings', 'feedback')) {
            Schema::table('ratings', function (Blueprint $table) {
                $table->dropColumn('feedback');
            });
        }
    }
};
