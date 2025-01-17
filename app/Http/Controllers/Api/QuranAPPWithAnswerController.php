<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QuranWordWithAnswer;
use Illuminate\Http\Request;

class QuranAPPWithAnswerController extends Controller
{
    public function AnswerWordApp($id){
        $data['data'] = QuranWordWithAnswer::where('TestingWords_id', $id)
        ->get();
    
        return response()->json($data);
    }

    public function submitAnswerAppQuranWord($questionId,     $selectedOption,       Request $request) {
       
    

        // Retrieve the correct_option from the Answers Table for this question_id
        $answer = QuranWordWithAnswer::where('TestingWords_id', $questionId)->first();

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
