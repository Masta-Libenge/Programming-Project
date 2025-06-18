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
        Schema::create('vacatures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ✅ bedrijf dat deze vacature aanmaakt
            $table->string('title');                                          // titel van vacature
            $table->text('desc');                                             // beschrijving
            $table->string('type');                                           // stage of werknemer
            $table->string('color')->default('#ffffff');                     // kleur van kaart
            $table->timestamps();                                            // created_at / updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacatures');
    }
};
