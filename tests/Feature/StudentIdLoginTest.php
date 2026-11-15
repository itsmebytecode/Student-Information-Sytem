<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentIdLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_student_can_log_in_with_their_student_id_and_password(): void
    {
        $user = User::factory()->create([
            'student_id' => 'STU-2026-001',
            'password' => 'correct-password',
        ]);

        $response = $this->post(route('login.store'), [
            'student_id' => 'STU-2026-001',
            'password' => 'correct-password',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    public function test_invalid_student_credentials_are_rejected(): void
    {
        User::factory()->create([
            'student_id' => 'STU-2026-002',
            'password' => 'correct-password',
        ]);

        $response = $this->from(route('login'))->post(route('login.store'), [
            'student_id' => 'STU-2026-002',
            'password' => 'incorrect-password',
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('student_id');
        $this->assertGuest();
    }

    public function test_student_id_is_required(): void
    {
        $response = $this->from(route('login'))->post(route('login.store'), [
            'password' => 'some-password',
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('student_id');
        $this->assertGuest();
    }

    public function test_an_authenticated_student_can_log_out(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('logout'));

        $response->assertRedirect('/login');
        $this->assertGuest();
    }
}
