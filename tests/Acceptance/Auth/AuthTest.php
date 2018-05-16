<?php

namespace Tests\Feature;

use Tests\TestCase;
use Yama\User\User;

class AuthTest extends TestCase
{
    public function testLoginFailsForNonExistentUser()
    {
        $this->followingRedirects()->post(
            "/login",
            ['email' => 'doesNotExist', 'password' => 'fooBar'],
            ['referer' => '/login']
        )->assertSee("credentials do not match");

        $this->assertFalse(\Auth::check());
    }


    public function testLoginFailsForWrongPassword()
    {
        /** @var User $user */
        $user = factory(User::class)->create();
        $this->followingRedirects()->post(
            "/login",
            ['email' => $user->email, 'password' => 'wrongPassword'],
            ['referer' => '/login']
        )->assertSee("credentials do not match");

        $this->assertFalse(\Auth::check());
    }


    public function testLoginWorksWithCorrectCredentials()
    {
        /** @var User $user */
        $user = factory(User::class)->create(['password' => bcrypt('myPassword')]);
        $this->followingRedirects()
            ->post("/login", ['email' => $user->email, 'password' => 'myPassword'])
            ->assertSee("<!-- Authenticated -->");

        $this->assertTrue(\Auth::check());
        $this->assertEquals($user->id, \Auth::user()->id);
    }


    public function testLogoutWorks()
    {
        /** @var User $user */
        $user = factory(User::class)->create(['password' => bcrypt('myPassword')]);
        $this->be($user);
        $this->assertTrue(\Auth::check());

        // logout while logged in
        $this->followingRedirects()->post("/logout")->assertStatus(200);

        $this->assertFalse(\Auth::check());

        // logout while not logged in
        $this->followingRedirects()->post("/logout")->assertStatus(200);

        $this->assertFalse(\Auth::check());
    }
}
