<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('files', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('user_id')->index();
        $table->integer('folder_id')->index()->nullable();
        $table->string('name')->index();
        $table->string('subject')->nullable();
        $table->string('content')->nullable();
        $table->string('is_private')->nullable();
        $table->string('credential')->nullable();
        $table->string('status');
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
        Schema::drop('files');
    }
}
