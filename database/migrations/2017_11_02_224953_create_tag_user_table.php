<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTagUserTable extends Migration {

	public function up()
	{
		Schema::create('tag_user', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('tag_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->enum('relation', ['like', 'neutral', 'dislike', 'taboo'])->index();

            $table->foreign('tag_id')->references('id')->on('tags')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

		});
	}

	public function down()
	{
        Schema::table('tag_user', function(Blueprint $table) {
            $table->dropForeign('tag_user_tag_id_foreign');
            $table->dropForeign('tag_user_user_id_foreign');
        });

		Schema::dropIfExists('tag_user');
	}
}
