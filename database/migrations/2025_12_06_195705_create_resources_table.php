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
        Schema::create('resources', function (Blueprint $table) {
            $table->id('resources_id'); // PK
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->string('file_url', 500);
            $table->string('faculty');
            $table->string('course_code');
            
            // For Admin Management: pending, approved, removed
            $table->enum('status', ['pending', 'approved', 'removed'])->default('pending');
            
            // Foreign Key to the users table
            $table->foreignId('user_id')->constrained('users', 'user_id');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
