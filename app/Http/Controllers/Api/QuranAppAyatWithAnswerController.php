<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuranAyatWithAnswer;

class QuranAppAyatWithAnswerController extends Controller
{
    public function AnswerAyatApp($id)
{
    // Retrieve data for the given TestingAyats_id and order by 'id'
    $data['data'] = QuranAyatWithAnswer::where('TestingAyats_id', $id)->get();

    // Log the API call with additional details
    addLApiChecked('AnswerAyatApp API Called', [
        'endpoint' => request()->fullUrl(),
        'method' => request()->method(),
        'testing_ayat_id' => $id,
        'record_count' => $data['data']->count(),
    ]);

    // Check if any data was retrieved
    if ($data['data']->isEmpty()) {
        // If no data is found, return a response with a message and 404 status
        return response()->json([
            'status' => 404,
            'message' => 'No answers found for the provided Testing Ayat ID.'
        ], 404);
    }

    // Return the data with the answers
    return response()->json([
        'status' => 200,
        'data' => $data['data'],
        'message' => 'Answers retrieved successfully'
    ]);
}


public function submitAnswerAppQuranAyat(Request $request)
{

    $questionId = $request->input('TestingAyats_id');
    $selectedOption = $request->input('selected_option');
    // Log the submission of the answer
    addLApiChecked('submitAnswerAppQuranAyat API Called', [
        'endpoint' => request()->fullUrl(),
        'method' => request()->method(),
        'question_id' => $questionId,
        'selected_option' => $selectedOption,
    ]);

    // Retrieve the correct_option from the QuranAyatWithAnswer Table for this question_id
    $answer = QuranAyatWithAnswer::where('TestingAyats_id', $questionId)->first();

    // Check if the answer exists
    if (!$answer) {
        return response()->json([
            'status' => 404,
            'message' => 'Answer not found for the provided question ID.'
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
