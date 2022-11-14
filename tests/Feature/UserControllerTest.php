<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get('/login')
            ->assertSeeText("Login");
    }

    public function testLoginPageForMember()
    {
        $this->withSession([
            "user" => "slm"
        ])->get('/login')
            ->assertRedirect("/");
    }


    public function testLoginSuccess()
    {
        $this->post('/login', [
            "user" => "slm",
            "password" => "slm17"
        ])->assertRedirect("/")
            ->assertSessionHas("user", "slm");
    }

    public function testLoginForUserAlreadyLogin()
    {
        $this->withSession([
            "user" => "slm"
        ]);
        $this->post('/login', [
            "user" => "slm",
            "password" => "slm17"
        ])->assertRedirect("/");
    }

    public function testLoginValError()
    {
        $this->post('/login', [])
            ->assertSeeText("User or password is required");
    }

    public function testLoginFailed()
    {
        $this->post('/login', [
            "user" => "wrong",
            "password" => "wrong"
        ])->assertSeeText("User or password is wrong");
    }

    public function testLogout()
    {
        $this->withSession([
            "user" => "slm"
        ])->post('/logout')
            ->assertRedirect('/')
            ->assertSessionMissing("user");
    }

    public function testLogoutGuest()
    {
        $this->post('/logout')
            ->assertRedirect('/');
    }
}
