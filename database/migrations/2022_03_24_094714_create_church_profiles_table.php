<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('church_profiles', function (Blueprint $table) {
     $table->bigIncrements('id');
    $table->string('churchName');
    $table->string('photo');
    $table->string('address');
    $table->string('email');
    $table->integer('phone');
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
        Schema::dropIfExists('church_profiles');
    }
};
