<?php

namespace App\Console\Commands;

use App\Models\File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CleanupExpiredUploads extends Command
{

    protected $signature = 'uploads:clean';
    protected $description = 'Delete expired files from storage and database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredUploads = File::where('expires_at', '<', now())->get();

        foreach ($expiredUploads as $expiredUpload) {

            if (Storage::disk('uploads')->exists($expiredUpload->stored_filename)){
                Storage::disk('uploads')->delete($expiredUpload->stored_filename);
                Log::info("Removed file: " . $expiredUpload->stored_filename);
            }

            $expiredUpload->delete();
            Log::info("Removed database entry for: " . $expiredUpload->stored_filename);
        }

    }
}
