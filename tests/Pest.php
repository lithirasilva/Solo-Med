<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". We will use the 
| RefreshDatabase trait for a clean database state during tests.
|
*/

pest()->extend(Tests\TestCase::class)
    ->use(Illuminate\Foundation\Testing\RefreshDatabase::class) // Use RefreshDatabase trait
    ->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| Extend the expect() function with custom expectations specific to your application.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| Define global helper functions that can be used in your tests to reduce code duplication.
|
*/

function createUser()
{
    return \App\Models\User::factory()->create();
}

function createPatient($attributes = [])
{
    return \App\Models\Patient::factory()->create($attributes);
}

function createAppointment($attributes = [])
{
    return \App\Models\Appointments::factory()->create($attributes);
}

function createMedicalRecord($attributes = [])
{
    return \App\Models\MedicalRecord::factory()->create($attributes);
}
