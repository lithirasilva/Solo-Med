<?php namespace Tests\Feature;

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppointmentManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_appointments_can_be_booked(): void
    {
        $this->actingAs($user = User::factory()->create());

        $this->post('/appointments', [
            'date' => '2024-10-01',
            'time' => '10:00',
            'patient_id' => $user->id,
        ]);

        $this->assertCount(1, Appointment::all());
        $this->assertEquals('2024-10-01 10:00:00', Appointment::latest()->first()->scheduled_at);
    }

    public function test_appointment_overlap_is_prevented(): void
    {
        $this->actingAs($user = User::factory()->create());
        
        $this->post('/appointments', [
            'date' => '2024-10-01',
            'time' => '10:00',
            'patient_id' => $user->id,
        ]);

        $response = $this->post('/appointments', [
            'date' => '2024-10-01',
            'time' => '10:00',
            'patient_id' => $user->id,
        ]);

        $response->assertSessionHasErrors();
    }

    public function test_appointments_can_be_canceled(): void
    {
        $this->actingAs($user = User::factory()->create());
        $appointment = Appointment::factory()->create(['patient_id' => $user->id]);

        $this->delete('/appointments/' . $appointment->id);

        $this->assertCount(0, Appointment::all());
    }
}
