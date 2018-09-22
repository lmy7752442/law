<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class LawyerController extends Controller
{
    /** 用户找律师 */
    public function Lawyer(){
        return view('lawyer');
    }

    /** 律师投稿 */
    public function tougao(){
        return view('tougao');
    }

}