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
        Schema::create('api_limits', function (Blueprint $table) {
            $table->id();
            $table->enum("date_type",[
                'minute',
                'hour',
                'day',
                'month',
            ])->default("minute");
            $table->integer("requests")->default(60);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_limits');
    }
};
