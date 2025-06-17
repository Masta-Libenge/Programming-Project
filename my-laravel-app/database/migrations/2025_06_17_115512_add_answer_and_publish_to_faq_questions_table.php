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
        Schema::table('faq_questions', function (Blueprint $table) {
            $table->text('answer')->nullable();
            $table->boolean('gepubliceerd')->default(false);
        });
    }
    
    public function down(): void
    {
        Schema::table('faq_questions', function (Blueprint $table) {
            $table->dropColumn(['answer', 'gepubliceerd']);
        });
    }
    
};
