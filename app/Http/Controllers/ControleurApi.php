<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControleurApi extends Controller
{
    public function connection(Request $request)
    {
        $test = ["message" => "Bonjour, mon API est fonctionnelle !"];
        return response()->json($test);
    }
}
