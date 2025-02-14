<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Log; // ✅ Laravel Logging
use Symfony\Component\Process\Exception\ProcessFailedException;

class AudioAnalysisController extends Controller
{
    public function compareAudio(Request $request)
    {
        // ✅ Step 1: Check karein ke dono audio files upload hui hain ya nahi
        if (!$request->hasFile('qari_audio') || !$request->hasFile('user_audio')) {
            Log::error("Audio Upload Error: Dono audio files zaroori hain.");
            return response()->json(['error' => 'Dono audio files zaroori hain'], 400);
        }

        // ✅ Step 2: Audio files ka sahi naam aur extension maintain karein
        $qariAudio = $request->file('qari_audio');
        $userAudio = $request->file('user_audio');

        $qariFilename = uniqid() . "_qari_audio.wav";  // ✅ Sahi filename
        $userFilename = uniqid() . "_user_audio.wav";  // ✅ Sahi filename

        $qariPath = storage_path("app/audio/" . $qariFilename);
        $userPath = storage_path("app/audio/" . $userFilename);

        // ✅ File ko move karne ke baad check karein ke sahi save hui ya nahi
        if (
            !$qariAudio->move(storage_path('app/audio'), $qariFilename) ||
            !$userAudio->move(storage_path('app/audio'), $userFilename)
        ) {
            Log::error("File Move Error: Audio files save nahi ho saki.");
            return response()->json(['error' => 'Audio file save failed'], 500);
        }

        Log::info("✅ Audio Files Saved Successfully!", [
            'qari_path' => $qariPath,
            'user_path' => $userPath
        ]);

        // ✅ Step 3: Python ka sahi path use karein
        $pythonPath = "/usr/bin/python3";  // ✅ Python ka exact path
        $scriptPath = base_path('python/compare.py');  // ✅ Python script ka exact path

        // ✅ Step 4: Python script ko run karein using Symfony Process
        $startTime = microtime(true);
        $process = new Process([$pythonPath, $scriptPath, $qariPath, $userPath]);
        $process->setTimeout(600);
        $process->run();
        $endTime = microtime(true);
        $executionTime = round($endTime - $startTime, 2);

        // ✅ Step 5: Debugging Logs (Python Raw Output)
        $rawOutput = trim($process->getOutput());
        $errorOutput = trim($process->getErrorOutput());

        Log::info("🐍 Python Script Raw Output: " . $rawOutput);
        Log::error("❌ Python Script Errors: " . $errorOutput);

        // ✅ Step 6: Agar script fail ho gayi
        if (!$process->isSuccessful()) {
            return response()->json([
                'error' => 'Python script execution failed!',
                'details' => $errorOutput,
                'execution_time' => "$executionTime seconds"
            ], 500);
        }

        // ✅ Step 7: JSON Response Laravel me parse karein
        $jsonOutput = json_decode($rawOutput, true);

        if (!$jsonOutput) {
            Log::error("❌ Python Script Returned Invalid JSON!", [
                'execution_time' => $executionTime . "s",
                'raw_output' => $rawOutput
            ]);
            return response()->json([
                'error' => 'Invalid response from Python script!',
                'raw_output' => $rawOutput, // ✅ Debugging ke liye actual output show karega
                'execution_time' => "$executionTime seconds"
            ], 500);
        }

        Log::info("✅ Python Script Executed Successfully!", [
            'execution_time' => "$executionTime seconds",
            'output' => $jsonOutput
        ]);

        return response()->json([
            'message' => 'Audio compared successfully!',
            'execution_time' => "$executionTime seconds",
            'output' => $jsonOutput
        ]);
    }
}
