<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QuranWordWithAnswer;
use Illuminate\Http\Request;

class QuranAPPWithAnswerController extends Controller
{
    public function AnswerWordApp($id)
{
    // Retrieve QuranWordWithAnswer records based on the provided TestingWords_id
    $data['data'] = QuranWordWithAnswer::where('TestingWords_id', $id)->get();

    // Log the API call with additional details
    addLApiChecked('AnswerWordApp API Called', [
        'endpoint' => request()->fullUrl(),
        'method' => request()->method(),
        'TestingWords_id' => $id,
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


public function submitAnswerAppQuranWord(Request $request)
{

    $questionId = $request->input('TestingWords_id');
    $selectedOption = $request->input('selected_option');
    // Retrieve the correct_option from the QuranWordWithAnswer Table for this question_id
    $answer = QuranWordWithAnswer::where('TestingWords_id', $questionId)->first();

    // Log the submission of the answer
    addLApiChecked('submitAnswerAppQuranWord API Called', [
        'endpoint' => request()->fullUrl(),
        'method' => request()->method(),
        'question_id' => $questionId,
        'selected_option' => $selectedOption,
    ]);

    // Check if the answer exists
    if (!$answer) {
        return response()->json([
            'status' => 404,
            'message' => 'Answer not found'
        ]);
    }

    // Check if the selected option is correct
    if ($selectedOption == $answer->correct_option) {
        $result = 'Correct!';
    } else {
        $result = 'Incorrect!';
    }

    // Return the result with status and message
    return response()->json([
        'status' => 200,
        'result' => $result,
        'message' => $result == 'Correct!' ? 'Correct answer!' : 'Incorrect answer, try again.'
    ]);
}

}
