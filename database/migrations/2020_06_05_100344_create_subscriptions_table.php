<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
          $table->increments('id');
          $table->foreignUuid('user_id');
          $table->integer('subscription_id');
          $table->string('user_name');
          $table->string('plan_name');
          $table->float('price');
          $table->string('start_at')->nullable();
          $table->string('ends_at')->nullable();
          $table->timestamps();
          $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
