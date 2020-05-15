<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('powers', function (Blueprint $table) {
            $table->increments("id");
            $table->enum('name', ['blast', 'Plague', 'mind control', 'ink fog', 'force shield', 'regeneration']);
            $table->integer("max_usage")->unsigned();
            $table->integer("kraken_id")->unsigned();
            $table->foreign('kraken_id')->references('id')->on('krakens')
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
        Schema::table('powers', function(Blueprint $table) {
            $table->dropForeign('power_kraken_id_foreign');
        });
        Schema::dropIfExists('powers');
    }
}
