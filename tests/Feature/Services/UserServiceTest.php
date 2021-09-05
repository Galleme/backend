<?php

namespace Tests\Feature\Services;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Contracts\Services\UserService as UserServiceInterface;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserServiceTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * User Service Object
     *
     * @var UserServiceInterface
     */
    protected $userService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userService = $this->app->make(UserServiceInterface::class);
    }

    public function test_all_success(): void
    {
        $userCount = 5;

        User::factory()->count($userCount)->create();

        $users = $this->userService->all();
        $this->assertEquals($userCount, $users->count());
    }
}
