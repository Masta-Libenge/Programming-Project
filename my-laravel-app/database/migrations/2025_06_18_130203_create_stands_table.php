<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stands', function (Blueprint $table) {
            $table->id();
            $table->string('aula'); // bv. AULA1, AULA2
            $table->integer('nummer'); // 1 t.e.m. 9 per aula
            $table->enum('status', ['vrij', 'gereserveerd'])->default('vrij');
            $table->unsignedBigInteger('bedrijf_id')->nullable();
            $table->timestamps();

            $table->foreign('bedrijf_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stands');
    }
};
