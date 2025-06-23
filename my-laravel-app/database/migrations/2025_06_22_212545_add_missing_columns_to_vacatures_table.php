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
    Schema::table('vacatures', function (Blueprint $table) {
        $table->string('sector')->nullable();
        $table->string('experience')->nullable();
        $table->string('salary')->nullable();
        $table->date('deadline')->nullable();
        $table->string('contract_duur')->nullable();
        $table->string('contract_type')->nullable();
        $table->string('werkrooster')->nullable();
        $table->string('studies')->nullable();
        $table->string('talenkennis')->nullable();
    });
}

public function down(): void
{
    Schema::table('vacatures', function (Blueprint $table) {
        $table->dropColumn([
            'sector',
            'experience',
            'salary',
            'deadline',
            'contract_duur',
            'contract_type',
            'werkrooster',
            'studies',
            'talenkennis',
        ]);
    });
}

};
