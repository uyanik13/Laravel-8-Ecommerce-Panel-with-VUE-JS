<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignUuid('user_id');
            $table->text('order_details')->nullable();
            $table->integer('order_id')->nullable();
            $table->float('price')->unsigned();
            $table->enum('status', ['pending', 'completed', 'returned'])->default('pending');
            $table->enum('order_status', ['in_process','shipped','cancelled','completed'])->default('in_process');
            $table->timestamps();
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

