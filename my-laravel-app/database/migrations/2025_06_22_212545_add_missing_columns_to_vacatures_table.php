<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingColumnsToVacaturesTable extends Migration
{
    public function up()
    {
        Schema::table('vacatures', function (Blueprint $table) {
            if (!Schema::hasColumn('vacatures', 'sector')) {
                $table->string('sector')->nullable();
            }
            if (!Schema::hasColumn('vacatures', 'experience')) {
                $table->string('experience')->nullable();
            }
            if (!Schema::hasColumn('vacatures', 'salary')) {
                $table->string('salary')->nullable();
            }
            // Ajoutez ici les autres colonnes que vous voulez ajouter,
            // chacune protégée avec un if (!Schema::hasColumn(...))
        });
    }

    public function down()
    {
        Schema::table('vacatures', function (Blueprint $table) {
            if (Schema::hasColumn('vacatures', 'sector')) {
                $table->dropColumn('sector');
            }
            if (Schema::hasColumn('vacatures', 'experience')) {
                $table->dropColumn('experience');
            }
            if (Schema::hasColumn('vacatures', 'salary')) {
                $table->dropColumn('salary');
            }
            // Idem pour les autres colonnes
        });
    }
}
