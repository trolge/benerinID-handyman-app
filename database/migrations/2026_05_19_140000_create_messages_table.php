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
        if (!Schema::hasTable('messages')) {
            Schema::create('messages', function (Blueprint $table) {
                $table->bigIncrements('MessageID');
                $table->unsignedBigInteger('JobID');
                $table->unsignedBigInteger('SenderID');
                $table->text('message');
                $table->boolean('is_read')->default(false);
                $table->timestamps();

                $table->index('JobID');
                $table->index('SenderID');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
