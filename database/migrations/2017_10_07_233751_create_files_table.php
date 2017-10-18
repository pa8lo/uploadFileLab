<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->string("is_public")->default("no");
            $table->string("is_folder");
            $table->string("folder_hash")->default("106a6c241b8797f52e1e77317b96a201");
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        // Schema::create('record_user', function (Blueprint $table){
        //     $table->increments('id');
        //     $table->integer('user_id')->unsigned();
        //     $table->integer('record_id')->unsigned();
        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        //     $table->foreign('record_id')->references('id')->on('records')->onDelete('cascade');
        //     $table->timestamps();
        // });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
}
