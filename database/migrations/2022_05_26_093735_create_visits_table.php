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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string("alias")->index();
            $table->string("country_code",2)->nullable();
            $table->string("ip",16)->nullable();
            $table->string("referer",512)->nullable();
            $table->string("browser",64)->nullable();
            $table->string("os",64)->nullable();
            $table->string("device",64)->nullable();
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
        Schema::dropIfExists('visits');
    }
};
