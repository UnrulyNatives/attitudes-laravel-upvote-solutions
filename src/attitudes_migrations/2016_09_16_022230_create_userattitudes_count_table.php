<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserattitudesCountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('userattitudes_counters', function (Blueprint $table) {
            $table->string('item_type', 32);
            $table->integer('item_id')->unsigned();
            $table->integer('count')->unsigned()->nullable()->default(null);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userattitudes_counters');
    }
}
