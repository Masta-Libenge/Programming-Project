<?php

// Import necessary classes for schema building and migrations
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Return an anonymous class that extends Laravel's Migration class
return new class extends Migration
{
    /**
     * Run the migrations.
     * This method is called when you run: php artisan migrate
     */
    public function up(): void
    {
        // Create the 'users' table
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('type', ['student', 'bedrijf', 'admin']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * This method is called when you run: php artisan migrate:rollback
     */
    public function down(): void
    {
        // Drop the 'users' table if it exists (roll back the migration)
        Schema::dropIfExists('users');
    }
};
