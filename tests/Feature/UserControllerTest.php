<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get('/login')->assertSeeText('Login');
    }

    public function testLoginSuccess()
    {
        $this->post('/login', [
            'user' => 'iqbal',
            'password' => 'qwerty',
        ])->assertRedirect('/')
            ->assertSessionHas('user', 'iqbal');
    }

    public function testLoginValidationError()
    {
        $this->post('/login')
            ->assertSeeText('User atau password tidak boleh kosong');
    }

    public function testLoginFailed()
    {
        $this->post('/login', [
            'user' => 'salah',
            'password' => 'salah',
        ])
            ->assertSeeText('User atau password salah');
    }

    public function testLogout()
    {
        $this->withSession([
            'user' => 'iqbal'
        ])->post('/logout')
            ->assertRedirect('/')
            ->assertSessionMissing('user');
    }

    public function testLoginPageForMember()
    {
        $this->withSession([
            'user' => 'iqbal'
        ])->get('/login')
            ->assertRedirect('/');
    }

    public function testLoginForUserAlreadyLogin()
    {
        $this->withSession([
            'user' => 'iqbal'
        ])->post('/login', [
            'user' => 'iqbal',
            'password' => 'qwerty'
        ])->assertRedirect('/');
    }
}
