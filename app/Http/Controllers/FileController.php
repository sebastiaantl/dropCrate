<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileController extends Controller
{
    // Saves uploaded file
    public function store(Request $request){

        $request->validate([
            'file' => 'required|file|mimes:pdf,png,jpeg,jpg,gif,zip,txt|max:10240',
            'password' => 'optional|string'
        ]);

        $uploadedFile = $request->file('file');
        $storedName = (string) Str::uuid() . '.' . $uploadedFile->getClientOriginalExtension();
        $path = Storage::disk('local')->putFileAs('uploads', $uploadedFile, $storedName);

        $file = File::create([
            'original_filename' => $uploadedFile->getClientOriginalName(),
            'stored_filename' => $storedName,
            'path' => $path,
            'short_url' => Str::random(6),
            'password' => $request->input('password'),
            'expires_at' => now()->addDays(1),
        ]);

        return response()->json([
            'message' => 'File uploaded successfully',
            'link' => url('/f/' . $file->short_url),
        ]);
    }
}
