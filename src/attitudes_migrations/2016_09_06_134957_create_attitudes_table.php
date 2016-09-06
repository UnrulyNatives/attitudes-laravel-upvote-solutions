<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attitudes', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('name', 128)->nullable();
            $table->string('item_type', 32);
            $table->integer('item_id')->unsigned();
            $table->integer('importance');
            $table->boolean('attitude')->nullable();
            $table->boolean('activated')->nullable()->default(1);
            $table->text('user_notes', 65535)->nullable();

            $table->integer('creator_id')->unsigned()->index('creator_id');
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
        Schema::drop('attitudes');
    }
}
