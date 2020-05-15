<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKrakensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('krakens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->integer("age")->unsigned();
            $table->float("size",8,2);
            $table->float("weight",8,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('krakens');
    }
}
