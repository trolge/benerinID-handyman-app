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
        Schema::create('handyman_jobs', function (Blueprint $table) {
            $table->id('JobID');
            $table->string('JobName');
            $table->string('JobType');
            $table->text('JobDesk')->nullable();
            $table->unsignedBigInteger('HandymanID')->nullable();
            $table->unsignedBigInteger('CustomerID');
            $table->integer('JobDuration')->nullable(); // duration in minutes/hours
            $table->string('JobStatus')->default('pending'); // pending, accepted, completed
            $table->timestamps();

            $table->foreign('HandymanID')->references('UserID')->on('users')->onDelete('set null');
            $table->foreign('CustomerID')->references('UserID')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('handyman_jobs');
    }
};
