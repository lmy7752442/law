<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AskController extends Controller
{
    public function ask(){
        return view('ask');
    }
}