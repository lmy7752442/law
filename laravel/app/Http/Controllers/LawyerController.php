<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class LawyerController extends Controller
{
    public function Lawyer(){
        return view('lawyer');
    }
}