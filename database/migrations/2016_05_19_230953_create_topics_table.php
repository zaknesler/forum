<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('body');
            $table->string('slug');
            $table->integer('user_id')->unsigned();
            $table->integer('section_id')->unsigned();
            $table->boolean('is_spam')->default(false);
            $table->boolean('is_locked')->default(false);
            $table->boolean('is_hidden')->default(false);
            $table->integer('reports_count')->default(0);
            $table->integer('views_count')->default(0);
            $table->timestamp('last_post_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('topics');
    }
}
