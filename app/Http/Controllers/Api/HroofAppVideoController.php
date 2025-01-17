<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HroofVideo;
use Illuminate\Http\Request;

class HroofAppVideoController extends Controller
{
    public function hroofVedio()
    {
        $data = HroofVideo::all(); 
        return response()->json($data);
    }
}
