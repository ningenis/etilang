<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViolationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('violations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('violator_identity_number');
            $table->string('violator_name');
            $table->integer('station_id')->unsigned();
            $table->string('status');
            $table->timestamps();
        });

        Schema::table('violations', function (Blueprint $table) {
            $table->integer('officer_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('violations');
        Schema::table('violations', function (Blueprint $table) {
            $table->dropColumn('officer_id');
        });
    }
}
