<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('packages', function (Blueprint $table) {
        $table->smallIncrements('id');
        $table->longText('title')->nullable();
        $table->longText('second_title')->nullable();
        $table->longText('description')->nullable();
        $table->longText('thumbnail')->nullable();
        $table->decimal('monthly_price',8,2)->nullable();
        $table->decimal('yearly_price',8,2)->nullable();
        $table->string('type')->nullable();
        $table->boolean('popular')->default(0);
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
        Schema::dropIfExists('packages');
    }
}
