<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Session\Session;
class PersonController extends Controller
{
    public function index(){
        return view('person');
    }
}