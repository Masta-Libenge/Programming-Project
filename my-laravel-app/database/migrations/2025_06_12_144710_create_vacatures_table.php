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
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // bedrijf
        $table->string('title');          // titel van vacature
        $table->text('desc');             // beschrijving
        $table->string('type');           // stage / werknemer / freelance
        $table->string('sector')->nullable();     // 🏷️ sector (medicine, tech...)
        $table->string('location')->nullable();   // 📍 locatie
        $table->string('experience')->nullable(); // 🎓 ervaringsniveau
        $table->string('salary')->nullable();     // 💰 verloning
        $table->date('deadline')->nullable();     // 🗓️ deadline voor solliciteren
        $table->string('color')->default('#ffffff'); // kleur voor kaart
        $table->timestamps();
        $table->string('contract_duur')->nullable();
$table->string('contract_type')->nullable(); // bv. "Voltijds", "Deeltijds"
$table->string('werkrooster')->nullable();   // bv. "Weekend", "Dagwerk"
$table->string('studies')->nullable();       // bv. "Geen specifieke studiereis"
$table->string('talenkennis')->nullable();   // bv. "Nederlands, Frans"
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
