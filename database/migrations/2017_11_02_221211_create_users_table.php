<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Yama\User\UserRepository;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191)->index();
            $table->string('email', 191)->unique()->index();
            $table->string('password')->nullable()->default(null);
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->enum('role', ['administrator', 'moderator', 'user'])->default('user');
            $table->integer('points')->default(0);
            $table->string('avatar')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        $adminPassword = str_random(32);

        $user           = app(UserRepository::class)->create([
            'name'        => 'Administrator',
            'email'       => 'change-me@example.org',
            'gender'      => 'female',
            'role'        => 'administrator',
            'avatar'      => '/img/mallard.jpg',
            'description' => 'I am the owner of this website!',
        ]);
        $user->password = bcrypt($adminPassword);
        $user->save();

        echo "\e[0;30;46m                                                \e[0m\n";
        echo "\e[0;30;46m  ############################################  \e[0m\n";
        echo "\e[0;30;46m  ##                                        ##  \e[0m\n";
        echo "\e[0;30;46m  ## \e[0;30;43m Administrator Username:             \e[0;30;46m  ##  \e[0m\n";
        echo "\e[0;30;46m  ## \e[1;33;40m   change-me@example.org             \e[0;30;46m  ##  \e[0m\n";
        echo "\e[0;30;46m  ##                                        ##  \e[0m\n";
        echo "\e[0;30;46m  ## \e[0;30;43m Administrator Password:             \e[0;30;46m  ##  \e[0m\n";
        echo "\e[0;30;46m  ## \e[1;33;40m   $adminPassword  \e[0;30;46m  ##  \e[0m\n";
        echo "\e[0;30;46m  ##                                        ##  \e[0m\n";
        echo "\e[0;30;46m  ############################################  \e[0m\n";
        echo "\e[0;30;46m                                                \e[0m\n";
    }


    public function down()
    {
        Schema::dropIfExists('users');
    }
}
