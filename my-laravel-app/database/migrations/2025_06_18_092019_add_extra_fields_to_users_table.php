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
        Schema::table('users', function (Blueprint $table) {
                    $table->string('voornaam')->nullable();
        $table->string('achternaam')->nullable();
        $table->string('opleiding')->nullable();
        $table->string('jaar')->nullable();
        $table->string('profile_picture')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['voornaam', 'achternaam', 'opleiding', 'jaar', 'profile_picture']);
    });
}

};
