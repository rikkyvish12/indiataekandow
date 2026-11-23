<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable()->default('text');
            $table->string('name')->nullable()->default('text');
            $table->string('type')->nullable()->default('text');
            $table->string('state')->nullable()->default('text');
            $table->string('title')->nullable()->default('text');
            $table->string('points')->nullable()->default('text');
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
        Schema::dropIfExists('member_profiles');
    }
}
