<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function view(Request $request)
    {
        var_dump($request);
    }
}
