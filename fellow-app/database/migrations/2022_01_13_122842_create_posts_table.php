<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->string('type')->default(0);
            $table->string('content');
            $table->string('localization')->nullable();
            $table->string('images')->nullable();
            $table->string('tags')->nullable();
            $table->string('advertising')->nullable();

            $table->integer('engagement')->default(0);
            $table->boolean('comments')->default(true);

            /* relacionamento */
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('posts');
    }
}
