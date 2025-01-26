<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuaidaAnswer;

class QuaidaAppAnswerController extends Controller
{
    public function AnswerApp($id)
    {
        // Retrieve Quaida answer details based on the given testing_id
        $data['data'] = QuaidaAnswer::where('testing_id', $id)->get();
    
        // Log the API call with additional details such as endpoint, method, and record count
        addLApiChecked('AnswerApp API Called', [
            'endpoint' => request()->fullUrl(),
            'method' => request()->method(),
            'record_count' => $data['data']->count(),
        ]);
    
        // Return the JSON response with status, message, record count, and data
        return response()->json([
            'status' => 200,
            'message' => 'Data retrieved successfully',
            'record_count' => $data['data']->count(),
            'data' => $data['data']
        ]);
    }
    


    public function submitAnswerApp(Request $request)
    {
        // Retrieve the question_id and selected_option from the form request
        $questionId = $request->input('testing_id');
        $selectedOption = $request->input('selected_option');
    
        // Retrieve the correct_option from the Answers Table for this question_id
        $answer = QuaidaAnswer::where('testing_id', $questionId)->first();
    
        // Log the API call with additional details
        addLApiChecked('submitAnswerApp API Called', [
            'endpoint' => request()->fullUrl(),
            'method' => request()->method(),
            'testing_id' => $questionId,
            'selected_option' => $selectedOption,
        ]);
    
        // Check if the answer exists for the given testing_id
        if (!$answer) {
            return response()->json([
                'status' => 404,
                'message' => 'Answer not found',
            ]);
        }
    
        // Check if the selected option matches the correct option
        if ($selectedOption == $answer->correct_option) {
            $result = 'Correct!';
        } else {
            $result = 'Incorrect!';
        }
    
        // Return the response with the result
        return response()->json([
            'status' => 200,
            'message' => 'Answer submitted successfully',
            'result' => $result,
        ]);
    }
    
    

}
