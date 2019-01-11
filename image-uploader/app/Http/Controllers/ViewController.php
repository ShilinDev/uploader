<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redis;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function getImage(Request $request)
    {
        Redis::set('qw','qwe');
        var_dump(1);
        var_dump(Redis::get('qw'));
    }
}
