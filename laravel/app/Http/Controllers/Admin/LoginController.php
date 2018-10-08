<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Index\SmsComController;
class LoginController extends Controller{
    public function login(){
        return view('login');
    }
}