<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('bill_address','2500')->nullable();
            $table->string('address','2000')->default('istanbul');
            $table->string('phone')->unique()->nullable();
            $table->string('avatar')->default('https://via.placeholder.com/150');
            $table->string('cv')->nullable();
            $table->text('social_data')->nullable();
            $table->text('about_data')->nullable();
            $table->text('user_data')->nullable();
            $table->text('notification_data')->nullable();
            $table->datetime('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('token')->nullable();
            $table->enum('role', ['admin','user'])->default('user');
            $table->enum('status', ['1', '0'])->default('1');
            $table->string('remember_token')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
