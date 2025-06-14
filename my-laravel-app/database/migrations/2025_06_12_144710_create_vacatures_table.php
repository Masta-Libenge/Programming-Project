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
            $table->string('title');                    // titel vacature
            $table->text('desc');                       // beschrijving
            $table->enum('type', ['Stage', 'Werknemer']); // stage / werknemer
            $table->string('color')->default('#ffffff'); // kaartkleur
            $table->unsignedBigInteger('bedrijf_id');
            $table->foreign('bedrijf_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
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
