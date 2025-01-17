<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BulkAudioUpload extends Command
{
    protected $signature = 'audio:bulk-upload';
    protected $description = 'Bulk upload audio files to Quaida_details table';

    public function handle()
    {
        $audioFilesPath = public_path('Quranfolder'); // Assuming 'Quranfolder' is your folder name
        $chunkSize = 100; // Adjust the chunk size as needed

        $audioFiles = glob($audioFilesPath . '/*.mp3');

        $chunks = array_chunk($audioFiles, $chunkSize);

        foreach ($chunks as $chunk) {
            $values = [];

            foreach ($chunk as $file) {
                $filename = pathinfo($file, PATHINFO_BASENAME);
                $values[] = "('$filename')";
            }

            $valuesString = implode(',', $values);

            DB::insert("INSERT INTO waqas (audio1) VALUES $valuesString ON DUPLICATE KEY UPDATE id = id");
        }

        $this->info('Bulk upload completed successfully.');
    }
}
