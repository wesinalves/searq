<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectionLocalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_local', function (Blueprint $table) {
            $table->integer('local_id')->unsigned();
            $table->integer('collection_id')->unsigned();
        });

        Schema::table('collections', function(Blueprint $table){
            $table->dropColumn(['type_id','local_id']);
            $table->dropForeign(['type_id','local_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collection_local');
    }
}
