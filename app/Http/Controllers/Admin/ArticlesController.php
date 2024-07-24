<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Pages;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

class ArticlesController extends Controller
{
    public function saveArticle(Request $request){
        if($request->id){
            $new = Article::find($request->id);
        }else{
            $new = new Article;
        }
        $new->title = $request->title; 
        $new->content = $request->content;    
     
        $res = $new->save();
        return $res;
        
    }
    public function getArticles(){
        return Article:: all();
    }

    public function deleteArticles(Request $request){
        Article::where('id', $request->id)->delete();
        return 1;
    }

    public function index(){
        return view('admin');
    }

    


}
 