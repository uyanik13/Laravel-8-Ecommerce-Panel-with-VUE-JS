<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('posts', function (Blueprint $table) {
      $table->increments('id');
      $table->foreignUuid('user_id');
      $table->unsignedSmallInteger('category_id')->nullable();
      $table->longText('title');
      $table->longText('content');
      $table->longText('options')->nullable();
      $table->longText('tags')->nullable();
      $table->float('price')->nullable();
      $table->float('discounted_price')->nullable();
      $table->integer('quantity')->nullable();
      $table->enum('currency', ['EURO', 'USD', 'GBP','TRY'])->default('USD');
      $table->longText('slug')->nullable();
      $table->longText('seo_title')->nullable();
      $table->longText('seo_description')->nullable();
      $table->enum('type', ['post', 'page', 'product','service','portfolio'])->default('post');
      $table->boolean('status');
      $table->longText('thumbnail')->nullable();
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
    Schema::dropIfExists('posts');
  }
}
