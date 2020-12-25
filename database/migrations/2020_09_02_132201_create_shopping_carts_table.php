<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_carts', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['wish', 'product'])->default('product');
            $table->string('session_id')->nullable();
            $table->foreignUuid('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->unsignedInteger('post_id')->nullable();
            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->float('price')->nullable();
            $table->boolean('sold')->default(false);
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
        Schema::dropIfExists('shopping_carts');
    }
}
