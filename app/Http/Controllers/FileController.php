<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class FileController extends Controller
{
    public function show($patientId, $filename)
    {
        // Here you can add logic to verify if the user has access to the file

        $path = "patient_files/$patientId/$filename";

        if (!Storage::disk('local')->exists($path)) {
            abort(404);
        }

        return response()->file(storage_path("app/$path"));
    }
}

