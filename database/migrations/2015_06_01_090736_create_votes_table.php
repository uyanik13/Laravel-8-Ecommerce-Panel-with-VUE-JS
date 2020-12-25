<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('votes', function (Blueprint $table) {
      $table->bigInteger('id')->primary();
      $table->foreignUuid('user_id');
      $table->integer('post_id')->unsigned();
      $table->boolean('status');
      $table->dateTime('allowed_to_vote_from')->nullable()->default(null);


    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('votes');
  }
}
