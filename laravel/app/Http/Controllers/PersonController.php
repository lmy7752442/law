<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Session\Session;
class PersonController extends Controller
{
    public function index(){
        $session = new Session;
        $openid = $session->get('openid');
        $data = DB::table('user')->where('openid',$openid)->first();
        $money = $data->money;
        return view('person',['money'=>$money]);
    }
}