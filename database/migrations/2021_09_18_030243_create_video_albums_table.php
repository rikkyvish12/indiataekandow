<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_albums', function (Blueprint $table) {
            $table->id();
            $table->string('event_name')->nullable()->default('text');
            $table->string('album_name')->nullable()->default('text');
            $table->string('coverImage')->nullable()->default('text');
            $table->string('timestamp')->nullable()->default('text');
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
        Schema::dropIfExists('video_albums');
    }
}
