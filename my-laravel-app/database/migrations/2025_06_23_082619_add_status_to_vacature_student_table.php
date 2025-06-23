<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToVacatureStudentTable extends Migration
{
    public function up()
    {
        Schema::table('vacature_student', function (Blueprint $table) {
            $table->string('status')->nullable(); // ou autre type adapté
        });
    }

    public function down()
    {
        Schema::table('vacature_student', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
