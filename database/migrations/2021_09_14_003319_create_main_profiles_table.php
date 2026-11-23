<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_profiles', function (Blueprint $table) {
            $table->id();
            $table->longText('mirache')->nullable();
            $table->longText('address')->nullable();
            $table->longText('map')->nullable();
            $table->longText('title')->nullable();
            $table->longText('description')->nullable();
            $table->longText('smallDescription')->nullable();
            $table->string('logo')->nullable()->default('text');
            $table->string('number')->nullable()->default('text');
            $table->string('email')->nullable()->default('text');
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
        Schema::dropIfExists('main_profiles');
    }
}
