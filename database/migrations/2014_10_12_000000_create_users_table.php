<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned(false);
            $table->string('uuid')->unique();    

            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone_code')->nullable();
            $table->string('phone_number')->unique()->nullable();
            $table->timestamp('phone_verified_at')->nullable();

            $table->boolean('is_social')->default(false);
            $table->text('social_id')->nullable();
            $table->string('social_email')->nullable();
            $table->enum('social_type', ['facebook', 'google', 'twitter', 'apple'])->nullable();
            $table->boolean('is_social_password_updated')->default(false);

            $table->string('password')->nullable();
            $table->enum('gender', ['male','female','other','both'])->nullable();
            $table->boolean('is_online')->nullable();

            $table->enum('type', ['user','salon','admin'])->nullable();

            $table->enum('status', ['pending','accepted','rejected'])->nullable();
            
            //only for salon
            $table->text('description')->nullable();
            $table->decimal('long', 10, 7)->nullable();
            $table->decimal('lat', 10, 7)->nullable();
            $table->text('address')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
