<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnAQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('un_a_quotations', function (Blueprint $table) {
            $table->increments('id');


            $table->longText('text'); 
            $table->string('author', 128);

            // these two will come in handy in later development of this package
            $table->integer('language_id')->unsigned()->nullable()->default(null); 
            $table->integer('author_id')->unsigned()->nullable()->default(null); 

            $table->integer('creator_id')->unsigned()->index('creator_id')->nullable()->default(null);
            $table->integer('updater_id')->unsigned()->index('updater_id')->nullable()->default(null);
            $table->timestamps();            
            $table->softDeletes();
            $table->integer('status')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('un_a_quotations');

    }
}
