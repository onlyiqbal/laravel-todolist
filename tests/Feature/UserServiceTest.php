<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertTrue;

class UserServiceTest extends TestCase
{
    private UserService $userSerive;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userSerive = $this->app->make(UserService::class);
    }

    public function testLoginSuccess(){
        self::assertTrue($this->userSerive->login('iqbal', 'qwerty'));
    }

    public function testLoginFaild(){
        self::assertFalse($this->userSerive->login('budi', 'rahasia'));
    }

    public function testLoginWrongPassword(){
        self::assertFalse($this->userSerive->login('iqbal', 'rahasia'));
    }
}
