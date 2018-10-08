<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class IndexController extends Controller{
    public function homepage(){
        return view('homepage');
    }

    /**
     * 文章管理视图
     */
    public function hot_article(){
        $article_info = DB::table('article')->get();

        return view('hot_article',['article_info'=>$article_info]);
    }

    /**
     * 文章数据
     */
    public function select_article(){
        $article_info = (array)DB::table('article')->get();

        $count = DB::table('article')->count();

        $data = [
            'msg'=>'ok',
            'code'=>0,
            'data'=>$article_info,
            'count'=>$count

        ];

        return $data;
    }


}