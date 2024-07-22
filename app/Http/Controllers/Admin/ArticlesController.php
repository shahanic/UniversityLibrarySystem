<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticlesController extends Controller
{
    public function saveArticle(Request $request){
        if($request->id){
            $new = Article::find($request->id);
        }else{
            $new = new Article;
        }

        $new->title = $request->title;    
        $new->abstract = $request->abstract;
        $new->content = $request->content;
        $new->status = $request->status;

        $res = $new->save();
        return $res;
        
    }
    public function getArticles(){
        return Article:: all();
    }

    public function deleteArticle(Request $request){
        Article::where('id', $request->id)->delete();
        return 1;
    }
    public function index(){
        return view('admin');
    }
    public function __construct()
    {
        $this->middleware('auth');
    }
}
