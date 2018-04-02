<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeToDimensionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dimensions', function (Blueprint $table) {
            //
            $table->integer('size');
            $table->enum('type',['documents','pages','sheets','items']);
            $table->enum('name', ['textual','iconografico','cartografico','tridimensional']);
            $table->unsignedInteger('collection_id');

            $table->foreign('collection_id')->references('id')->on('collations')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dimensions', function (Blueprint $table) {
            //
            $table->dropColumn(['size','type','collection_id']);
        });
    }
}
