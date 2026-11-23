<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHallOfFamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hall_of_fames', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->default('text');
            $table->string('title')->nullable()->default('text');
            $table->string('date')->nullable()->default('text');
            $table->longText('description')->nullable();
            $table->string('coverImage')->nullable()->default('text');
            $table->string('coverImage1')->nullable()->default('text');
            $table->string('coverImage2')->nullable()->default('text');
            $table->string('coverImage3')->nullable()->default('text');
            $table->string('intro')->nullable()->default('text');
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
        Schema::dropIfExists('hall_of_fames');
    }
}
