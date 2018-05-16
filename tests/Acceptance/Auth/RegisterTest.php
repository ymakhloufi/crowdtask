<?php

namespace Tests\Acceptance\Auth;

use Tests\TestCase;
use Yama\User\User;

class RegisterTest extends TestCase
{
    public function testRegistrationFailsIfAnyRequiredFieldIsMissing()
    {
        $this->followingRedirects()
            ->post("/register", [
                '_email'    => 'foo@example.com',
                '_password' => 'fooPassword',
            ])->assertSee("name field is required");

        $this->followingRedirects()
            ->post("/register", [
                '_email' => 'foo@example.com',
                '_name'  => 'fooName',
            ])->assertSee("password field is required");

        $this->followingRedirects()
            ->post("/register", [
                '_password' => 'fooPassword',
                '_name'     => 'fooName',
            ])->assertSee("email field is required");

        $this->assertFalse(\Auth::check());
    }


    public function testRegistrationFailsIfEmailIsMalformed()
    {
        $this->followingRedirects()
            ->post("/register", [
                '_email'    => 'malformed_email',
                '_password' => 'fooPassword',
                '_name'     => 'fooName',
            ])->assertSee("email must be a valid email address");
    }


    public function testRegistrationFailsIfPasswordIsTooShort()
    {
        $this->followingRedirects()
            ->post("/register", [
                '_email'    => 'foo@example.com',
                '_password' => 'short',
                '_name'     => 'fooName',
            ])->assertSee("password must be at least");
    }


    public function testRegistrationFailsIfEmailIsNotUnique()
    {
        factory(User::class)->create(['email' => 'unique@example.com']);

        $this->followingRedirects()
            ->post("/register", [
                '_email'    => 'unique@example.com',
                '_password' => 'fooPass',
                '_name'     => 'fooName',
            ])->assertSee("email has already been taken");

        $this->assertFalse(\Auth::check());
    }


    public function testRegistrationSucceedsAndLogsTheUserIn()
    {

        $email    = $this->faker->email;
        $name     = $this->faker->name;
        $password = $this->faker->password(6, 20);

        $userCount = User::query()->count();

        $this->followingRedirects()
            ->post("/register", [
                '_email'    => $email,
                '_password' => $password,
                '_name'     => $name,
            ])->assertSee("<!-- Authenticated -->");

        $this->assertEquals($userCount + 1, User::query()->count());
        $this->assertTrue(\Auth::check());
        $this->assertEquals(\Auth::user()->id, User::query()->latest()->pluck('id')->first());
        $this->assertEquals(\Auth::user()->email, $email);
        $this->assertEquals(\Auth::user()->name, $name);
        $this->assertEquals(\Auth::user()->email, $email);
        $this->assertTrue(password_verify($password, \Auth::user()->password));
    }
}
