<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommentsTable extends Migration
{

    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('commentable_id')->unsigned()->index();
            $table->string('commentable_type', 191)->index();
            $table->integer('user_id')->nullable()->default(null)->unsigned();
            $table->text('text')->nullable();
            $table->tinyInteger('rating')->nullable()->unsigned()->index(); // 1-5 "stars"
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }


    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign('comments_user_id_foreign');
        });

        Schema::dropIfExists('comments');
    }
}
