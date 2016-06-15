<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('location')->nullable();
            $table->string('website')->nullable();
            $table->text('about')->nullable();
            $table->string('image_uuid')->nullable();
            $table->string('password');
            $table->boolean('view_profile')->default(true);
            $table->boolean('view_profile_email')->default(false);
            $table->boolean('suspended')->default(false);
            $table->integer('topics_count')->default(0);
            $table->integer('posts_count')->default(0);
            $table->rememberToken();
            $table->timestamp('suspended_at')->nullable();
            $table->timestamp('last_login_at')->nullable();
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
        Schema::drop('users');
    }
}
