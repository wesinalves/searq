<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescriptionToCollationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('collections', function (Blueprint $table) {
            //
            $table->string('code',250);
            $table->string('title',250);
            $table->date('start_date');
            $table->date('end_date')->nullable;
            $table->text('biography')->nullable();
            $table->text('history')->nullable();
            $table->text('origin')->nullable();
            $table->text('evaluate')->nullable();
            $table->text('incorporation')->nullable();
            $table->text('level_system')->nullable();
            $table->enum('access',['restricted','private','public'])->nullable();
            $table->text('reproduction')->nullable();
            $table->text('features')->nullable();
            $table->text('tools')->nullable();
            $table->string('origin_localization',250)->nullable();
            $table->string('copy_localization',250)->nullable();
            $table->text('unit_description')->nullable();
            $table->text('description_date')->nullable();
            $table->text('rules')->nullable();

            $table->unsignedInteger('level_id')->nullable();
            $table->unsignedInteger('type_id')->nullable();
            $table->unsignedInteger('local_id')->nullable();

            $table->foreign('level_id')->references('id')->on('levels')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('local_id')->references('id')->on('locales')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedInteger('collection_id')->nullable();

            $table->foreign('collection_id')->references('id')->on('collections')->onDelete('restrict')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('collections', function (Blueprint $table) {
            //
        });
    }
}
