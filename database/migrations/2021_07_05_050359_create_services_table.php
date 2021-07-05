<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id')->unsigned(false);
            $table->string('uuid')->unique();

            $table->integer('salon_id');
            $table->foreign('salon_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->string('name')->nullable();
            $table->double('price')->default(0.0);

            $table->integer('slot')->nullable();
            $table->enum('status', ['active','in-active'])->default('active');
            $table->time('time')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
