<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('email')->unique()->index();
            $table->string('password');
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->enum('role', ['administrator', 'moderator', 'user'])->default('user');
            $table->string('avatar')->nullable()->default(null);
            $table->text('description')->default('');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('users');
    }
}
