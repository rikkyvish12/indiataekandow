<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleToTaekwondos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('taekwondos', function (Blueprint $table) {
                $table->longText('Taekwondo')->nullable();
                $table->longText('tfi')->nullable();
                $table->longText('Swimming')->nullable();
                $table->longText('Fencing')->nullable();
                $table->longText('Riding')->nullable();
                $table->longText('LaserRun')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('taekwondos', function (Blueprint $table) {
            //
        });
    }
}
