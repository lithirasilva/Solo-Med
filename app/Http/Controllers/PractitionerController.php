<?php

namespace App\Http\Controllers;

use App\Models\Practitioner;
use App\Http\Requests\StorePractitionerRequest;
use App\Http\Requests\UpdatePractitionerRequest;

class PractitionerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePractitionerRequest $request)
    {
        $validatedData = $request->validate([
            'doctorId' => 'required|string|max:255',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:practitioners',
            'phone' => 'required|string|max:20',
            'address.street' => 'required|string|max:255',
            'address.city' => 'required|string|max:255',
            'address.province' => 'required|string|max:255',
            'address.postalCode' => 'required|string|max:10',
            'address.country' => 'required|string|max:255',
            'dateOfBirth' => 'required|date',
            'specialty' => 'required|string|max:255',
            'medicalCouncilRegistration' => 'required|string|max:255',


        ]);

        $practitioner = Practitioner::create($validatedData);



        //return redirect()->route('patients.index')->with('success', 'Patient created successfully.');
        dd( $request );
    }

    /**
     * Display the specified resource.
     */
    public function show(Practitioner $practitioner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Practitioner $practitioner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePractitionerRequest $request, Practitioner $practitioner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Practitioner $practitioner)
    {
        //
    }
}
