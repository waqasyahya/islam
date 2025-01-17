<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuaidaGuaide;

class QuaidaAppGuaideController extends Controller
{
    public function QuaidaGuaideApp($id){
     
        $data['data'] = QuaidaGuaide::where('Quaida_id', $id)
        ->get();

        return response()->json($data);
    }
 
}
