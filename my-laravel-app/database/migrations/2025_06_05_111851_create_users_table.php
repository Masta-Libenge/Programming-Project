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
            $table->id(); // Auto-incrementing primary key named 'id'

            $table->string('name'); // String column for the user's name

            $table->string('email')->unique(); // String column for email, must be unique across all users

            $table->string('password'); // String column to store the hashed password

            $table->enum('type', ['student', 'bedrijf', 'admin']); 
            // Enum column that restricts the user type to one of the three values

            $table->timestamps(); 
            // ✅ Adds two columns: 'created_at' and 'updated_at' (automatically managed by Laravel)
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
