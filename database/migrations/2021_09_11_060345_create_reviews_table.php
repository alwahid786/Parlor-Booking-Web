<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id')->unsigned(false);
            $table->string('uuid')->unique();

            $table->integer('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('salon_id')->nullable();
            $table->foreign('salon_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('appointment_id')->nullable();
            $table->foreign('appointment_id')->references('id')->on('appointments')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('service_id')->nullable();
            $table->foreign('service_id')->references('id')->on('services')->onUpdate('cascade')->onDelete('cascade');

            $table->double('rating')->nullable();
            $table->text('review')->nullable();
            $table->boolean('is_attended_appointment')->nullable();


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
        Schema::dropIfExists('reviews');
    }
}
