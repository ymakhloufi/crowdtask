<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTagTaskTable extends Migration {

	public function up()
	{
		Schema::create('tag_task', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('tag_id')->unsigned();
			$table->integer('task_id')->unsigned();

            $table->foreign('tag_id')->references('id')->on('tags')
                ->onDelete('cascade')
                ->onUpdate('cascade');

			$table->foreign('task_id')->references('id')->on('tasks')
                ->onDelete('cascade')
                ->onUpdate('cascade');
		});
	}

	public function down()
	{
        Schema::table('tag_task', function(Blueprint $table) {
            $table->dropForeign('tag_task_tag_id_foreign');
            $table->dropForeign('tag_task_task_id_foreign');
        });

		Schema::dropIfExists('tag_task');
	}
}
