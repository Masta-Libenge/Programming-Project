<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'voornaam')) {
                $table->string('voornaam')->nullable();
            }
            if (!Schema::hasColumn('users', 'achternaam')) {
                $table->string('achternaam')->nullable();
            }
            if (!Schema::hasColumn('users', 'opleiding')) {
                $table->string('opleiding')->nullable();
            }
            if (!Schema::hasColumn('users', 'jaar')) {
                $table->string('jaar')->nullable();
            }
            if (!Schema::hasColumn('users', 'profile_picture')) {
                $table->string('profile_picture')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'voornaam', 
                'achternaam', 
                'opleiding', 
                'jaar', 
                'profile_picture'
            ]);
        });
    }
};
