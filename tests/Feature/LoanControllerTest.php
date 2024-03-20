<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoanControllerTest extends TestCase
{
    public function test_user_register_api() {
        $response = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'test-api@example.com',
            'password' => 'password',
        ]);

        $this->assertAuthenticated('api');
        $response->assertStatus(200);
    }

    public function test_user_login_api() {
        $user = User::factory()->create();

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated('api');
        $response->assertStatus(200);
    }

    public function test_apply_for_loan() {
        $user = User::factory()->create();

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->postJson('/apply-loan', [
            'amount' => '1000',
            'user_id' => $user->id,
        ]);
        $this->assertAuthenticated('api');
        $response->assertStatus(200);
    }
}
