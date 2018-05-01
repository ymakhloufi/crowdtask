<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 32)->index();
			$table->string('email', 128)->unique()->index();
			$table->string('password', 128);
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->enum('role', ['administrator', 'moderator', 'user'])->default('user');
			$table->string('avatar', 512)->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
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
