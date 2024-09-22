<?
namespace Tests\Feature;

use App\Models\User;
use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PatientAddingTest extends TestCase
{
    use RefreshDatabase;

    public function test_patients_can_be_added(): void
    {
        $this->actingAs($user = User::factory()->create());

        $this->post('/patients', [
            'name' => 'John Doe',
            'dob' => '1990-01-01',
            'email' => 'john@example.com',
        ]);

        $this->assertCount(1, Patient::all());
        $this->assertEquals('John Doe', Patient::latest()->first()->name);
    }

    public function test_patient_requires_valid_information(): void
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->post('/patients', [
            'name' => '',
            'dob' => 'invalid-date',
            'email' => 'invalid-email',
        ]);

        $response->assertSessionHasErrors(['name', 'dob', 'email']);
    }
}
