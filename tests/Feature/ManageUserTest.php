<?php   
namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertCount(1, User::all());
        $this->assertEquals('Jane Doe', User::latest()->first()->name);
    }

    public function test_users_can_login(): void
    {
        $user = User::factory()->create(['password' => bcrypt('password')]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($user);
    }

    public function test_password_reset_functionality(): void
    {
        $user = User::factory()->create(['password' => bcrypt('old-password')]);

        // Simulate password reset request
        $response = $this->post('/password/email', [
            'email' => $user->email,
        ]);

        // Simulate resetting password
        $this->assertDatabaseHas('password_resets', ['email' => $user->email]);
        // Here you would need to simulate the reset link usage and test if the password can be updated.
    }
}
