<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTasksTable extends Migration
{

    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_user_id')->unsigned()->nullable()->default(null);
            $table->string('title')->index();
            $table->text('description');
            $table->boolean('private')->default(false)->index();
            $table->timestamp('approved_at')->nullable()->index();
            $table->timestamps();

            $table->foreign('author_user_id')->references('id')->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }


    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign('tasks_author_user_id_foreign');
        });

        Schema::dropIfExists('tasks');
    }
}
