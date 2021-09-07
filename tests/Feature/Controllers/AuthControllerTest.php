<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class AuthControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Artisan::call('passport:install');
    }

    public function test_login_success(): void
    {
        $credentials = [
            'email' => Str::random() . '@galleme.test',
            'password' => Str::random(16),
        ];

        User::factory()->create([
            'email' => $credentials['email'],
            'password' => bcrypt($credentials['password'],)
        ]);

        $this->postJson(route('v1.auth.login'), $credentials)
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'user',
                'token',
                'expires_at',
            ])
            ->assertJsonPath('user.email', $credentials['email']);
    }

    public function test_login_missing_password_field(): void
    {
        $credentials = [
            'email' => Str::random() . '@galleme.test',
            'password' => Str::random(16),
        ];

        User::factory()->create([
            'email' => $credentials['email'],
            'password' => bcrypt($credentials['password'],)
        ]);

        $this->postJson(route('v1.auth.login'), ['email' => $credentials['email']])
            ->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'fields',
            ]);
    }

    public function test_login_missing_email_field(): void
    {
        $credentials = [
            'email' => Str::random() . '@galleme.test',
            'password' => Str::random(16),
        ];

        User::factory()->create([
            'email' => $credentials['email'],
            'password' => bcrypt($credentials['password'],)
        ]);

        $this->postJson(route('v1.auth.login'), ['password' => $credentials['password']])
            ->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'fields',
            ]);
    }

    public function test_login_wrong_credentials(): void
    {
        $credentials = [
            'email' => Str::random() . '@galleme.test',
            'password' => Str::random(16),
        ];

        User::factory()->create([
            'email' => $credentials['email'],
            'password' => bcrypt($credentials['password'],)
        ]);

        $this->postJson(route('v1.auth.login'), ['email' => $credentials['email'], 'password' => 'something else'])
            ->assertStatus(401)
            ->assertJsonStructure([
                'message',
            ]);
    }
}
