<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssignmentsTable extends Migration {

	public function up()
	{
		Schema::create('assignments', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('task_id')->unsigned();
			$table->integer('assigner_user_id')->nullable()->default(null)->unsigned(); // for soft-deleted assigners
			$table->integer('assignee_user_id')->unsigned();
			$table->text('assignee_text');
            $table->boolean('community_rated')->default(true)->index();
            $table->enum('status', ['new', 'rejected', 'accepted', 'fulfilled', 'passed', 'failed'])->index();
			$table->timestamps();
			$table->softDeletes();

            $table->foreign('task_id')->references('id')->on('tasks')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('assigner_user_id')->references('id')->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('assignee_user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
		});
	}

	public function down()
	{
        Schema::table('assignments', function(Blueprint $table) {
            $table->dropForeign('assignments_task_id_foreign');
            $table->dropForeign('assignments_assigner_user_id_foreign');
            $table->dropForeign('assignments_assignee_user_id_foreign');
        });

		Schema::dropIfExists('assignments');
	}
}
