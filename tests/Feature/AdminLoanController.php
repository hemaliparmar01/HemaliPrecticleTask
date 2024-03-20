<?php

namespace Tests\Feature;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminLoanController extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_update_loan_status(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => '12345678',
        ]);

        $this->assertAuthenticated();
        $loan = Loan::first();
        $this->get('loan-status-change/'.$loan->id);
        $response->assertRedirect('/');
    }
}
