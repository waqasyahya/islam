<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\QuaidaDetail;

use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use FFMpeg\Format\Audio\Wav; // ✅ Correct import


class QuaidaAppDetailController extends Controller
{

    public function QuaidaDetailApp($id)
    {
        // Retrieve Quaida details based on the given Quaida_id
        $data['data'] = QuaidaDetail::where('Quaida_id', $id)->get();

        // Loop through each item and modify the audio path and add file type
        foreach ($data['data'] as $item) {
            $audioPath = public_path('Quranfolder/' . $item->audio1);
            $item->audio1 = asset('/Quranfolder/' . $item->audio1);

            // Get the file type (extension) and add it to the $item array
            $item->file_type = pathinfo($audioPath, PATHINFO_EXTENSION);
        }

        // Log the API call with details such as endpoint, method, and record count
        addLApiChecked('QuaidaDetailApp API Called', [
            'endpoint' => request()->fullUrl(),
            'method' => request()->method(),
            'record_count' => $data['data']->count(),
        ]);

        // Return the JSON response with status, message, and data
        return response()->json([
            'status' => 200,
            'message' => 'Data retrieved successfully',
            'record_count' => $data['data']->count(),
            'data' => $data['data']
        ]);
    }
    public function compareAudio(Request $request, $quaida_id, $words_id)
    {
        // ✅ Step 1: Validate input (User must upload one audio file)
        if (!$request->hasFile('user_audio')) {
            Log::error("❌ Audio Upload Error: User audio file required.");
            return response()->json(['error' => 'User audio file zaroori hai'], 400);
        }

        // ✅ Step 2: Fetch database audio for the specific word inside the lesson
        $wordDetail = QuaidaDetail::where('Quaida_id', $quaida_id)
            ->where('Words_id', $words_id)
            ->first();

        if (!$wordDetail) {
            Log::error("❌ Database Error: Quaida ID or Word ID not found.");
            return response()->json(['error' => 'Invalid Quaida ID or Word ID!'], 404);
        }

        $qariAudioUrl = public_path('Quranfolder/' . $wordDetail->audio1);

        if (!file_exists($qariAudioUrl)) {
            Log::error("❌ File Not Found: " . $qariAudioUrl);
            return response()->json(['error' => 'Qari ki audio file nahi mili!'], 404);
        }

        // ✅ Step 3: Store user uploaded audio
        $userAudio = $request->file('user_audio');
        $userFilename = uniqid() . "_" . $userAudio->getClientOriginalName();
        $userPath = storage_path("app/audio/" . $userFilename);

        $userAudio->move(storage_path('app/audio'), $userFilename);

        Log::info("✅ Uploaded User Audio Saved!", ['user_path' => $userPath]);

        // ✅ Step 4: Run Python script
        $pythonPath = "/usr/bin/python3";
        $scriptPath = base_path('python/compare.py');

        $process = new Process([$pythonPath, $scriptPath, $qariAudioUrl, $userPath]);
        $process->setTimeout(600);
        $process->run();

        $rawOutput = trim($process->getOutput());
        $errorOutput = trim($process->getErrorOutput());

        // Log::info("🐍 Python Script Raw Output: " . $rawOutput);
        // Log::error("❌ Python Script Errors: " . $errorOutput);

        if (!$process->isSuccessful()) {
            return response()->json([
                'error' => 'Python script execution failed!',
                'details' => $errorOutput
            ], 500);
        }

        $jsonOutput = json_decode($rawOutput, true);

        if (!$jsonOutput) {
            Log::error("❌ Python Script Returned Invalid JSON!", ['raw_output' => $rawOutput]);
            return response()->json([
                'error' => 'Invalid response from Python script!',
                'raw_output' => $rawOutput
            ], 500);
        }

        Log::info("✅ Python Script Executed Successfully!", ['output' => $jsonOutput]);

        // ✅ Step 5: Delete user uploaded audio after comparison
        if (file_exists($userPath)) {
            unlink($userPath);
            Log::info("🗑️ User audio deleted successfully!", ['user_path' => $userPath]);
        } else {
            Log::warning("⚠️ User audio file not found for deletion!", ['user_path' => $userPath]);
        }

        return response()->json([
            'message' => 'Audio compared successfully!',
            'output' => $jsonOutput
        ]);
    }
}
