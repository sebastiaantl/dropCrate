<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class FileController extends Controller
{
    // Saves uploaded file
    public function store(Request $request){

        $request->validate([
            'file' => 'required|file|mimes:pdf,png,jpeg,jpg,gif,zip,txt|max:10240',
            'password' => 'nullable|string'
        ]);

        $uploadedFile = $request->file('file');
        $storedName = (string) Str::uuid() . '.' . $uploadedFile->getClientOriginalExtension();
        $path = Storage::disk('local')->putFileAs('uploads', $uploadedFile, $storedName);

        $file = File::create([
            'original_filename' => $uploadedFile->getClientOriginalName(),
            'stored_filename' => $storedName,
            'path' => $path,
            'short_url' => Str::random(6),
            'password' => Hash::make($request->input('password')),
            'expires_at' => now()->addDays(1),
        ]);

        return response()->json([
            'message' => 'File uploaded successfully',
            'link' => url('/f/' . $file->short_url),
        ]);
    }

    public function show(Request $request, $short_url){

        $file = File::where('short_url', $short_url)->firstOrFail();


        return Inertia::render('show', ['file' => $file, 'locked' => $file['password'] == null ? false : true]);


    }


    public function download(Request $request, $short_url){

        $file = File::where('short_url', $short_url)->firstOrFail();

        if ($file['password'] != null){

            $validated = $request->validate([
                'password' => 'required|string'
            ]);

            if (!Hash::check($validated['password'], $file['password'],)){
                return response()->json([
                    'message' => 'Incorrect password.',
                ], 403);
            }

        }

        return Storage::download($file['path'], $file['original_filename']);

    }

}
