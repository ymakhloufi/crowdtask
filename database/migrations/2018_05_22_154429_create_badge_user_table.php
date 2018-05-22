<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBadgeUserTable extends Migration
{

    public function up()
    {
        Schema::create('badge_user', function (Blueprint $table) {
            $table->string('badge_title');
            $table->integer('user_id')->unsigned();
            $table->timestamp('created_at');

            $table->primary(['badge_title', 'user_id']);

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        });
    }


    public function down()
    {
        Schema::table('badge_user', function (Blueprint $table) {
            $table->dropForeign('badge_user_user_id_foreign');
        });

        Schema::dropIfExists('badge_user');
    }
}
