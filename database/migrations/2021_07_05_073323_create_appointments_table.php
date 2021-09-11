<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id')->unsigned(false);
            $table->string('uuid')->unique();

            $table->integer('salon_id');
            $table->foreign('salon_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->date('date')->nullable();

            $table->integer('slot')->nullable();
            $table->enum('status', ['active','cancelled','completed','rejected','on-hold'])->default('on-hold');
            $table->double('total_price')->default(0.0);
            $table->integer('discount')->nullable();
            $table->boolean('is_attended')->nullable();

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
        Schema::dropIfExists('appointments');
    }
}
