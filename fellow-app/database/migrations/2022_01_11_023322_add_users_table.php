<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('cpf')->unique()->nullable();
            $table->integer('role')->default(0);
            $table->string('image_avatar')->nullable();
            $table->string('image_cover')->nullable();
            $table->string('email_contact')->nullable();
            $table->longText('description')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('id_user')->nullable();
            $table->boolean('verify')->default(false);

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
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
