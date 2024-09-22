<?php namespace Tests\Feature;

use App\Models\User;
use App\Models\Patient;
use App\Models\MedicalRecord;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MedicalRecordsManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_medical_records_can_be_created(): void
    {
        $this->actingAs($user = User::factory()->create());
        $patient = Patient::factory()->create();

        $this->post('/medical-records', [
            'patient_id' => $patient->id,
            'description' => 'Consultation details',
        ]);

        $this->assertCount(1, MedicalRecord::all());
        $this->assertEquals('Consultation details', MedicalRecord::latest()->first()->description);
    }

    public function test_medical_record_file_upload(): void
    {
        $this->actingAs($user = User::factory()->create());
        $patient = Patient::factory()->create();

        $response = $this->post('/medical-records', [
            'patient_id' => $patient->id,
            'file' => UploadedFile::fake()->create('prescription.pdf', 100),
        ]);

        $this->assertCount(1, MedicalRecord::all());
        $this->assertNotNull(MedicalRecord::latest()->first()->file_path);
    }
}
