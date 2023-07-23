<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class userReadDataApi extends Controller
{
    //
    public function index(Request $request):JsonResponse
    {
        $data = User::all();
        return response()->json(['status' => 200, 'message' => 'Data Retrived Succesfully', 'data' => $data]);

    }
}
