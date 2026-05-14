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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('TransID');
            $table->unsignedBigInteger('JobID');
            $table->unsignedBigInteger('HandymanID');
            $table->unsignedBigInteger('CustomerID');
            $table->timestamps();

            $table->foreign('JobID')->references('JobID')->on('handyman_jobs')->onDelete('cascade');
            $table->foreign('HandymanID')->references('UserID')->on('users')->onDelete('cascade');
            $table->foreign('CustomerID')->references('UserID')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
