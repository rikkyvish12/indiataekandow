<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associations', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->string('logo')->nullable();
            $table->string('name')->nullable();
            $table->string('presidentName')->nullable();
            $table->longText('presidentDescription')->nullable();
            $table->string('presidentEmail')->nullable();
            $table->string('presidentPhoto')->nullable();
            $table->string('secretaryName')->nullable();
            $table->longText('secretaryDescription')->nullable();
            $table->string('secretaryEmail')->nullable();
            $table->string('secretaryPhoto')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('associations');
    }
}
