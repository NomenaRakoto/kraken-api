<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTentaclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tentacles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->integer('point_de_vie')->unsigned();
            $table->integer('strength')->unsigned();
            $table->integer('dexterity')->unsigned();
            $table->integer('stamina')->unsigned();
            $table->integer('kraken_id')->unsigned();
            $table->foreign('kraken_id')
                  ->references('id')
                  ->on('krakens')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tentacles', function(Blueprint $table) {
            $table->dropForeign('tentacles_kraken_id_foreign');
        });
        Schema::dropIfExists('tentacles');
    }
}
