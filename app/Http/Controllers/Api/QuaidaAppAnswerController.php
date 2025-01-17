<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuaidaAnswer;

class QuaidaAppAnswerController extends Controller
{
    public function AnswerApp($id){
        $data['data'] = QuaidaAnswer::where('testing_id', $id)
        ->get();
    
        return response()->json($data);
      }


      public function submitAnswerApp(Request $request) {
        $questionId = $request->input('testing_id'); // Retrieve the question_id from the form
        $selectedOption = $request->input('selected_option'); // Retrieve the selected option

        // Retrieve the correct_option from the Answers Table for this question_id
        $answer = QuaidaAnswer::where('testing_id', $questionId)->first();

        if (!$answer) {
            return response()->json(['result' => 'Answer not found'], 404);
        }

        if ($selectedOption == $answer->correct_option) {
            $result = 'Correct!';
        } else {
            $result = 'Incorrect!';
        }

        return response()->json(['result' => $result]);

    }
    

}
